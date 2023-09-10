<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BedSpace;
use App\Helpers\BrowserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use function App\View\Components\send_mail;
use function App\View\Components\createNotification;



class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }

    public function profilesettings()
    {
        // $user = User::find(Auth::id())->first();
        // dd(User::find(Auth::id())->webAuthnCredentials()->where('id', 'N2UGkUifVxzPvPb46pb7Zkav8T4c0qpbVo1lwOl6Ih4')->update([
        //     'set_default' => true,
        //     'device_data' => ['iuywtbdnm'],
        //     'device_ip' => 'the test ip',
        //     'device_name' => 'device name',
        // ]));
        return view('pages.staff.settings');
    }

    public function deleteUser($id, Request $request)
    {
        $remove_resident = BedSpace::where('user_id', $id)->update([
            'allocated' => false,
            'user_id' => Null,
        ]);
        User::where('id', $id)->delete();
        return redirect('/users/')->with('success', 'User was deleted');
    }
    public function disable_resident($id)
    {
        User::where('id', $id)->update([
            'disable_login' => true
        ]);
        return redirect()->back()->with('success', 'User account was Disabled');
    }

    public function enable_resident($id)
    {
        User::where('id', $id)->update([
            'disable_login' => false
        ]);
        return redirect()->back()->with('success', 'User account is Enabled');
    }

    public function disallow_change_profile_picture($id)
    {
        User::where('id', $id)->update([
            'disable_picture_update' => true
        ]);
        return redirect()->back()->with('success', 'User restricted from changing profile picture');
    }

    public function allow_change_profile_picture($id)
    {
        User::where('id', $id)->update([
            'disable_picture_update' => false
        ]);
        return redirect()->back()->with('success', 'User can now change profile picture');
    }

    public function disable_guest($id)
    {
        User::where('id', $id)->update([
            'disable_guest' => true
        ]);
        return redirect()->back()->with('success', 'You have disabled user from recieving guest');
    }

    public function enable_guest($id)
    {
        User::where('id', $id)->update([
            'disable_guest' => false
        ]);
        return redirect()->back()->with('success', 'You have enabled user to recieve guest');
    }

    public function update_max_guest_per_day(Request $request, $id)
    {
        User::where('id', $id)->update([
            'max_guest_per_day' => $request->value ?? null
        ]);
        if (DB::table('settings')->value('global_max_guest_per_day') < $request->value) {
            return redirect()->back()->with('success', 'You have you have increased max guest by day for this user');
        } elseif (DB::table('settings')->value('global_max_guest_per_day') > $request->value) {
            return redirect()->back()->with('success', 'You have you have reduced max guest by day for this user');
        } else {
            return redirect()->back()->with('success', 'You have you have updated max guest by day for this user');
        }
    }

    public function updeteUserPassword($id, Request $request)
    {


        if ($request->confirmNewPassword !== $request->newPassword) {
            // Current password and new password same
            return redirect()->back()->with("error", "Comfirm Password did not match.");
        }

        // $validatedData = $request->validate([
        //     'newPassword' => 'required|string|min:8|confirmed',
        // ]);

        //Change Password
        User::where('id', $id)->update([
            'password' => bcrypt($request->get('newPassword')),
        ]);
        // $user = Auth::user();
        // $user->password = bcrypt($request->get('newPassword'));
        // $user->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }

    public function index()
    {
        return view('pages.dashboard');
    }


    public function users_login_activities()
    {



        $viewingYear = DB::table('settings')->value('viewing_year');
        $logins = DB::table('login_details')->where('year', $viewingYear)->orderBy('login_date', 'desc')->get();
        return view('pages.user-logins')->with('logins', $logins);
    }

    public function invoices(Request $request)
    {

        $viewingYear = DB::table('settings')->value('viewing_year');

        if ($request->sort == 'pending') {
            $invoices = DB::table('invoices')->where('year', $viewingYear)->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        } elseif ($request->sort == 'successful') {
            $invoices = DB::table('invoices')->where('year', $viewingYear)->where('status', 'successful')->orderBy('created_at', 'desc')->get();
        } else {
            $invoices = DB::table('invoices')->where('year', $viewingYear)->orderBy('created_at', 'desc')->get();
        }

        return view('pages.invoices')->with('invoices', $invoices);
    }

    public function resident_invoices(Request $request, User $user)
    {

        $viewingYear = DB::table('settings')->value('viewing_year');

        if ($request->sort == 'pending') {
            $invoices = DB::table('invoices')->where('user_id', $user->id)->where('year', $viewingYear)->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        } elseif ($request->sort == 'successful') {
            $invoices = DB::table('invoices')->where('user_id', $user->id)->where('status', 'successful')->orderBy('created_at', 'desc')->get();
        } else {
            $invoices = DB::table('invoices')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('pages.resident-invoices')->with([
            'invoices' => $invoices,
            'user' => $user,
        ]);
    }
    public function direct_payments()
    {
        return view('pages.direct-payments');
    }

    public function manual_payment()
    {
        return view('pages.manual-payment');
    }

    public function create_payment($application_no)
    {
        $invoice = DB::table('invoices')->where('application_no', $application_no)->first();
        // dd($invoice);
        if ($invoice && $invoice->payment_status != 'paid') {
            return view('pages.create-payment')->with('invoice', $invoice);
        } elseif ($invoice && $invoice->payment_status == 'paid') {
            return redirect()->back()->with('error', 'Invoice with Appliaction No: ' . $application_no . ' has already been paid');
        } else {
            return redirect()->back()->with('error', 'Invalid Appliaction No');
        }
    }

    public function delete_payment($application_no)
    {

        $invoice = DB::table('invoices')->where('application_no', $application_no)->delete();
        return redirect()->back()->with('success', 'Record has been deleted');
        // echo 'deleted';
        // dd($invoice);
        //    $invoice->delete($application_no->id);

    }

    public function create_manual_payment(Request $request)
    {
        $invoice = DB::table('invoices')->where('application_no', $request->application_no)->first();
        if ($invoice) {

            // dd($invoice);
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
            $transaction_id = strtoupper(substr($random, 0, 12));

            $payment_data = json_encode([
                'status' =>  'success',
                'amount' =>  $request->amount,
                'original_amount' => $invoice->original_amount ?? $invoice->amount,
                // 'percentage_off' =>  $request->amount,
                'transaction_date' =>  date('Y-m-d H:i:s'),
                'admin_id' => Auth::user()->id,
                'admin_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'admin_email' =>  Auth::user()->email,
                'message' => $request->message,
            ]);

            DB::table('manual_payment')->insert([
                'transaction_id' =>  $transaction_id,
                'application_no' => $invoice->application_no,
                'amount' => $request->amount,
                'type' =>  $request->type,
                'payment_data' =>  $payment_data,
                'year' =>  DB::table('settings')->value('current_year'),
            ]);



            if ($invoice->type == 'Rent Booking') {

                $rent = DB::table('rents')->where('payment_reference', $invoice->application_no)->first();

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $payment_data,
                    'amount' => $request->amount,
                    'original_amount' => $invoice->original_amount ?? $invoice->amount,
                    'payment_status' => 'paid',
                    'payment_method' => 'Bank Transfer',
                    'status' => 'successful',
                    'user_id' =>  $rent->user_id,
                    'transaction_id' =>  $transaction_id,
                ]);
                DB::table('rents')->where('payment_reference', $invoice->application_no)->update([
                    'proof_status' => 'Approved',
                    'school_check_status' => 'Approved',
                ]);
                // dd($rent);

                if ($rent->referral_code != null) {
                    DB::table('referrals_earnings')->insert([
                        'amount' =>  DB::table('settings')->value('referral_amount'),
                        'referent' =>  $rent->user_id,
                        'referrer' =>  User::where('referral_code', $rent->referral_code)->value('id'),
                        'referral_code' =>  $rent->referral_code,
                    ]);
                }

                $link = url('/booking/' . $rent->id);

                $input = ['[full_name]', '[transaction_id]', '[link]', '[type]', '[auth]'];
                $outfilled = [$invoice->full_name, $transaction_id, $link ?? '', $invoice->type, ''];
                $message =  str_replace($input, $outfilled,  DB::table('settings')->value('manual_payment_confirmation_message'));

                send_mail($invoice->full_name, $invoice->email, 'Rent Booking Payment', $message);

                return redirect('/booking/' . $rent->id)->with([
                    'success' => 'User Rent has been paid, Transaction ID has been sent to User Email',
                    'transaction_id' => $transaction_id
                ]);
            } elseif ($invoice->type == 'Registration Form') {

                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
                $code = substr($random, 0, 8);

                $firstname = '';
                $middlename = '';
                $lastname = '';

                $parts = explode(' ', $invoice->full_name);
                if (count($parts) === 2) {
                    list($firstname, $lastname) = $parts;
                } elseif (count($parts) === 3) {
                    list($firstname, $middlename, $lastname) = $parts;
                }
                if (count($parts) === 1) {
                    $firstname = $invoice->full_name;
                    $lastname = '-';
                }


                $referral_code = json_decode($invoice->payment_data, true);

                $referral_code = $referral_code['referral_code'] ?? '';

                $password = 'pass' . substr($random, 0, 6);
                // dd([
                //     'first_name' => $firstname,
                //     'middle_name' => $middlename,
                //     'last_name' =>  $lastname,
                //     'email' => $invoice->email,
                //     'year' =>  DB::table('settings')->value('current_year'),
                //     'phone_number' => $invoice->phone_number,
                //     'password' => Hash::make($password),
                //     'referrer' => User::where('referral_code', $referral_code)->value('id'),
                //     'application_form_number' => $invoice->application_no,
                //     'verification_code' => $code,
                //     'email_verified_at' => Carbon::now(),
                // ]);
                $user = User::create([
                    'first_name' => $firstname,
                    'middle_name' => $middlename,
                    'last_name' =>  $lastname,
                    'email' => $invoice->email,
                    'year' =>  DB::table('settings')->value('current_year'),
                    'phone_number' => $invoice->phone_number,
                    'password' => Hash::make($password),
                    'referrer' => User::where('referral_code', $referral_code)->value('id'),
                    'application_form_number' => $invoice->application_no,
                    'verification_code' => $code,
                    'email_verified_at' => Carbon::now(),
                ]);

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'user_id' =>  $user->id,
                    'amount' => $request->amount,
                    'original_amount' => $invoice->original_amount ?? $invoice->amount,
                    'transaction_id' =>  $transaction_id,
                    'payment_data' =>  $payment_data,
                    'payment_status' => 'paid',
                    'payment_method' => 'Online Payment',
                    'status' => 'successful',
                ]);

                // 
                $auth = '<h4>Login Details</h4>';
                $auth .= '<br>Email: ' . $invoice->email;
                $auth .= '<br>Password: ' . $password;

                $link = url('/profile');

                $input = ['[full_name]', '[transaction_id]', '[link]', '[type]', '[auth]'];
                $outfilled = [$invoice->full_name, $transaction_id, $link ?? '', $invoice->type, $auth];
                $message =  str_replace($input, $outfilled,  DB::table('settings')->value('manual_payment_confirmation_message'));


                send_mail($invoice->full_name, $invoice->email, 'Registration Form Payment', $message);

                createNotification('New Registration', $firstname, 'Registered an Account');

                return redirect('/invoices')->with('success', 'Payment has been completed');
            } else if ($service = DB::table('purchased_services')->where('application_no', $invoice->application_no)->first()) {

                // dd($service);
                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $payment_data,
                    'payment_status' => 'paid',
                    'payment_method' => 'Bank Transfer',
                    'status' => 'successful',
                    'user_id' =>  $service->user_id,
                    'transaction_id' =>  $transaction_id,
                ]);

                DB::table('purchased_services')->where('service_uid', $service->service_uid)->update([
                    // 'service_uid' => $data->service_uid,
                    // 'application_no' => $invoice->application_no,
                    // 'user_id' => $invoice->user_id,
                    'status' => 'purchased'
                ]);


                return redirect('/invoices')->with('success', 'Payment has been completed');
            }
        }
    }

    public function notifications()
    {
        $notifications = DB::table('notifications')->where('year', DB::table('settings')->value('viewing_year'))->orderBy('id', "DESC")->simplePaginate(10);
        return view('pages.notifications')->with('notifications', $notifications);
    }

    public function settings()
    {
        $roles = Role::all();
        return view('pages.settings')->with([
            // 'supervisors' =>  $supervisors,
            'roles' =>  $roles,
            // 'departments' =>  $departments,
        ]);
    }

    public function update_site_files(Request $request)
    {



        if ($request->agreement) {

            request()->validate([
                'agreement' => 'required|file|mimes:pdf',
            ]);

            $filesName = 'agreement.pdf';
            $request->agreement->storeAs('', $filesName, 'public_uploads');
        }

        if ($request->code_of_conduct) {

            request()->validate([
                'code_of_conduct' => 'required|file|mimes:pdf',
            ]);

            $filesName = 'code_of_conduct.pdf';
            $request->code_of_conduct->storeAs('/', $filesName, 'public_uploads');
        }

        // dd($request->all());
        return redirect()->back()->with('success', 'Files Updated');
    }

    public function emailTemplate()
    {
        return view('pages.email_template');
    }

    public function delete_admin($id)
    {
        $admins = DB::table('users')->delete($id);
        return redirect()->back();
    }

    public function financials()
    {

        return view('pages.financials');
    }

    public function billing_details($id)
    {

        $billing = DB::table('rents')->where('id', $id)->first();
        // $user_id = $rent->user_id;
        return view('pages.financial')->with(['billing' => $billing]);
    }


    public function checks(Request $request)
    {
        $user_id = $request->input('user_id');
        $step = $request->input('step');
        $status = $request->input('status');
    }

    public function choose_year(Request $request)
    {
        $check = DB::table('settings')->get();
        if (count($check) == 0) {
            DB::table('settings')->insert([
                'viewing_year' => $request->input('viewing_year')
            ]);
        } else {
            DB::table('settings')->update([
                'viewing_year' => $request->input('viewing_year')
            ]);
        }
        return redirect()->back();
    }

    public function update_settings(Request $request)
    {
        $check = DB::table('settings')->get();
        if (count($check) == 0) {
            DB::table('settings')->insert([
                'business_name' => $request->input('business_name'),
                'bank_name' => $request->input('bank_name'),
                'bank_account' => $request->input('bank_account'),
                'whatsapp_number' => $request->input('whatsapp_number'),

            ]);
        } else {
            DB::table('settings')->update([
                'business_name' => $request->input('business_name'),
                'bank_name' => $request->input('bank_name'),
                'bank_account' => $request->input('bank_account'),
                'whatsapp_number' => $request->input('whatsapp_number'),
            ]);
        }
        return redirect('settings');
    }

    public function update_site_settings(Request $request)
    {
        $check = DB::table('settings')->get();
        if (count($check) == 0) {
            DB::table('settings')->insert([
                'registration_form_price' => $request->input('registration_form_price'),
                'complaints_management_role' => $request->input('complaints_management_role'),
            ]);
        } else {
            DB::table('settings')->update([
                'registration_form_price' => $request->input('registration_form_price'),
                'complaints_management_role' => $request->input('complaints_management_role'),
            ]);
        }
        return redirect('settings');
    }

    public function update_email_template(Request $request)
    {
        $check = DB::table('settings')->get();

        if (count($check) == 0) {

            if ($request->application_status) {
                $check->application_status = $request->application_status;
            }
            if ($request->school_details_approved) {
                $check->school_details_approved = $request->school_details_approved;
            }
            $check->save();

            // DB::table('settings')->insert([


            //     'reg_email_template'=>$request->input('reg_email_template'),
            //     'payment_email_template'=>$request->input('payment_email_template'),
            //     'file_email_template'=>$request->input('file_email_template'),
            //     'complain_email_template'=>$request->input('complain_email_template'),


            // ]);
        } else {

            if ($request->approved_document_message) {
                DB::table('settings')->update([
                    'approved_document_message' => $request->approved_document_message,
                ]);
            }

            if ($request->lawyer_new_document_email) {
                DB::table('settings')->update([
                    'lawyer_new_document_email' => $request->lawyer_new_document_email,
                ]);
            }
            if ($request->new_user_registration_message) {
                DB::table('settings')->update([
                    'new_user_registration_message' => $request->new_user_registration_message,
                ]);
            }

            if ($request->application_recieved_message) {
                DB::table('settings')->update([
                    'application_recieved_message' => $request->application_recieved_message,
                ]);
            }

            if ($request->guarantor_form_message) {
                // dd($request->all());
                $filesName = DB::table('settings')->value('guarantor_form_file');

                if ($request->guarantor_form_file) {
                    $filesName = 'guarantor-' . date('Y-m-d') . '.pdf';
                    $request->guarantor_form_file->storeAs('site-files', $filesName, 'public_uploads');
                }

                DB::table('settings')->update([
                    'guarantor_form_message' => $request->guarantor_form_message,
                    'guarantor_form_file' => 'site-files/' . $filesName,
                ]);
            }

            if ($request->attestation_form_message) {
                // dd($request->all());

                $filesName = DB::table('settings')->value('attestation_form_file');

                if ($request->attestation_form_file || $request->attestation_form_file) {
                    $filesName = 'attestation-form-' . date('Y-m-d') . '.pdf';
                    $request->attestation_form_file->storeAs('site-files', $filesName, 'public_uploads');
                }

                DB::table('settings')->update([
                    'attestation_form_message' => $request->attestation_form_message,
                    'attestation_form_file' => 'site-files/' . $filesName,
                ]);
            }

            if ($request->new_staff_created_email) {
                // dd($request->all());
                DB::table('settings')->update([
                    'new_staff_created_email' => $request->new_staff_created_email,
                ]);
            }

            if ($request->health_form_message || $request->health_form_file) {
                // dd($request->all());
                $filesName = DB::table('settings')->value('health_form_file');
                if ($request->health_form_file) {

                    $filesName = 'health-form-' . date('Y-m-d') . '.pdf';
                    $request->health_form_file->storeAs('site-files', $filesName, 'public_uploads');
                }

                DB::table('settings')->update([
                    'health_form_message' => $request->health_form_message,
                    'health_form_file' => 'site-files/' . $filesName,
                ]);
            }

            if ($request->manual_payment_confirmation_message) {
                DB::table('settings')->update([
                    'manual_payment_confirmation_message' => $request->manual_payment_confirmation_message,
                ]);
            }

            if ($request->school_details_approved_message) {
                DB::table('settings')->update([
                    'school_details_approved_message' => $request->school_details_approved_message,
                ]);
            }
            if ($request->rent_approved_message) {
                DB::table('settings')->update([
                    'rent_approved_message' => $request->rent_approved_message,
                ]);
            }
            if ($request->rent_archived_message) {
                DB::table('settings')->update([
                    'rent_archived_message' => $request->rent_archived_message,
                ]);
            }

            if ($request->rent_expired_message) {
                DB::table('settings')->update([
                    'rent_expired_message' => $request->rent_expired_message,
                ]);
            }

            if ($request->renewal_request_template) {
                DB::table('settings')->update([
                    'renewal_request_template' => $request->renewal_request_template,
                ]);
            }

            if ($request->renewal_status_template) {
                DB::table('settings')->update([
                    'renewal_status_template' => $request->renewal_status_template,
                ]);
            }

            if ($request->rent_renewal_notice) {
                DB::table('settings')->update([
                    'rent_renewal_notice' => $request->rent_renewal_notice,
                ]);
            }

            // DB::table('settings')->update([

            //     'reg_email_template'=>$request->input('reg_email_template'),
            //     'payment_email_template'=>$request->input('payment_email_template'),
            //     'file_email_template'=>$request->input('file_email_template'),
            //     'complain_email_template'=>$request->input('complain_email_template'),

            // ]);
        }
        return redirect()->back()->with('success', 'Settings Saved!');
    }

    public function update_email_recipients(Request $request)
    {
        $check = DB::table('settings')->get();
        if (count($check) == 0) {
            DB::table('settings')->insert([

                'reg_email_recipient' => $request->input('reg_email_recipient'),
                'payment_email_recipient' => $request->input('payment_email_recipient'),
                'file_email_recipient' => $request->input('file_email_recipient'),
                'complaint_email_recipient' => $request->input('complaint_email_recipient'),
            ]);
        } else {
            DB::table('settings')->update([

                'reg_email_recipient' => $request->input('reg_email_recipient'),
                'payment_email_recipient' => $request->input('payment_email_recipient'),
                'file_email_recipient' => $request->input('file_email_recipient'),
                'complaint_email_recipient' => $request->input('complaint_email_recipient'),
            ]);
        }
        return redirect('settings');
    }



    public function create_amenities(Request $request)
    {

        DB::table('amenities')->insert([
            'name' => $request->input('name'),
            'year' => DB::table('settings')->value('current_year'),
        ]);

        return redirect()->back();
    }

    public function years(Request $request)
    {

        DB::table('years')->insert([
            'year' => $request->input('year'),
        ]);

        //Insert New Year to Database as Current year
        $check = DB::table('settings')->get();
        if (count($check) == 0) {
            DB::table('settings')->insert([
                'current_year' => $request->input('year'),
                'viewing_year' => $request->input('year')
            ]);
        } else {
            DB::table('settings')->update([
                'current_year' => $request->input('year'),
                'viewing_year' => $request->input('year')
            ]);
        }

        return redirect()->back();
    }


    public function update_admin(Request $request, $id)
    {

        if ($request->input('role') != null) {
            $role = $request->input('role');
        } else {
            $role = DB::table('users')->where('id', $id)->value('role');
        }

        if ($request->input('password') != null) {
            $password = Hash::make($request->input('password'));
        } else {
            $password = DB::table('users')->where('id', $id)->value('password');
        }

        // dd($role.'p:'.$password);

        DB::table('users')->where('id', $id)->update([
            'role' => $role,
            'password' => $password,
        ]);


        return redirect()->back();
    }

    public function create_admin(Request $request)
    {

        DB::table('users')->insert([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'year' => DB::table('settings')->value('current_year'),
        ]);

        return redirect()->back();
    }

    public function update_ofbar(Request $request)
    {
        DB::table('ofbar')->update([
            'content' => $request->content,
            'button' => $request->button ? true : false,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
        ]);
        return redirect()->back()->with('success', 'settings saved');
    }

    public function message(Request $request)
    {
        DB::table('messages')->insert([
            'user_id' => $request->input('user_id'),
            'tasks_id' => $request->input('tasks_id'),
            'message' => $request->input('message'),
            'status' => $request->status ?? 'sent',
            'year' => DB::table('settings')->value('current_year'),
            'created_at' => \Carbon\Carbon::now(),
        ]);

        if ($request->input('user_id') == 'all') {
            //send bullk mail
            $mail_data = [
                'subject' =>  'New Message from Admin - ' . config('app.name', 'Laravel'),
                'message' => $request->input('message'),
            ];
            // send all mail in the queue.
            $job = (new \App\Jobs\SendMail($mail_data))->delay(now()->addSeconds(2));
            dispatch($job);
        } else {
            send_mail(DB::table('users')->where('id', $request->input('user_id'))->value('first_name'), DB::table('users')->where('id', $request->input('user_id'))->value('email'), 'New Message from Admin - ' . config('app.name', 'Laravel'), $request->input('message'));
            DB::table('user_notifications')->insert([
                'user_id' =>  $request->input('user_id'),
                'title' => 'New Admin Message check your email for details',
                'message' => 'New Admin Message check your email for details',
                'status' => 'unread',
                'year' => DB::table('settings')->value('current_year')
            ]);
        }



        return redirect()->back();
    }
}
