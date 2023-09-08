<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function App\View\Components\createNotification;
use function App\View\Components\send_mail;

class CheckStudentVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Get the Rent Table
        $rent = DB::table('rents');

        //Check if it is Student
        if (auth()->user()->role == 'student') {

            if (Auth::user()->disable_login == true) {
                return redirect('logout?error=account_deactivated');
                // session('logout_error', 'Your Acoount has been disabled by administrator');
                
            }

            if(!Auth::user()->email_verified_at){
                // $message= 'Hello '.Auth::user()->first_name.', use this code to verify your account at talents apartment : '.Auth::user()->verification_code.'';
                // send_mail(Auth::user()->first_name, Auth::user()->email, 'Talents Apartment Verification Code', $message);
                $invoice = DB::table('invoices')->where('application_no', auth()->user()->application_form_number)->first();
                // dd(auth()->user()->application_form_number);
                $input = ['[first_name]', '[middle_name]', '[last_name]', '[verification_code]', '[pass]', '[profile_link]', '[payment_type]', '[payment_amount]', '[payment_method]', '[application_number]', '[transaction_id]', '[invoice_link]'];
                $outfilled = [auth()->user()->first_name, auth()->user()->middle_name, auth()->user()->last_name, Auth::user()->verification_code, $password ?? '', url('/profile'), $invoice->type, $invoice->amount, $invoice->payment_method, $invoice->application_no, $invoice->transaction_id, url('/invoice/'.$invoice->application_no)];
                $message =  str_replace($input, $outfilled, DB::table('settings')->value('new_user_registration_message'));
                send_mail(auth()->user()->first_name, auth()->user()->email, 'Talents Apartment Verification', $message);
                
                return response()->view('auth.emailsent');
            }

            if(Auth::user()->gender == null  || Auth::user()->level == null || Auth::user()->matric_number == null){
               
               return redirect('personal_info');
              
            }
            if(Auth::user()->g_phone_number == null  || Auth::user()->g_first_name == null ){
               return redirect('guardian_info');
            }
            if(count(DB::table('rents')->where('user_id',Auth::user()->id)->get()) == 0){
                return redirect('book');
            }
            $current_rent = DB::table('rents')->where('id',Auth::user()->current_rent)->first();
            $invoice =  DB::table('invoices')->where('application_no', $current_rent->payment_reference)->first();

            if($invoice->status != 'successful' || $invoice->payment_status != 'paid'){
                return redirect('purchase/booking/'.$current_rent->id);
            }

            // if (count(DB::table('rents')->where('user_id', Auth::user()->id)->get()) < 2 && DB::table('rents')->where('id', auth()->user()->current_rent)->value('school_check_status') != "Approved") {
            //     // return response()->view('auth.await_verification');
            //     // dd(DB::table('rents')->where('id', auth()->user()->current_rent)->value('school_check_status'));
            //     return redirect('await_verification');
            // }

            // if ($rent->where('user_id', auth()->user()->id)->value('updated_at') > Carbon::now()->subDays(7)) {
            //     // return response()->view('auth.await_verification');
            //     return redirect('/services');
            // }
        }
        //Verified Give Access
        return $next($request);
    }
}
