<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laragear\WebAuthn\Models\WebAuthnCredential;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biometrics_options(Request $request, User $user)
    {
        // dd($request->all());
        $message = '';
        if ($request->action == 'activate') {
            $user->update([
                'enable_biometrics' => true,
            ]);
            $message = 'Your Device Will be used for authentication in your next login';
        } else {
            $user->update([
                'enable_biometrics' => false,
            ]);
            $message = 'You have successfully deactivated biometrics on your device';
        }

        return redirect()->back()->with("success", $message);
    }

    public function enable_device(User $user, WebAuthnCredential $credential)
    {
        $credential->enable();


        $user->update([
            'enable_biometrics' => true,
        ]);

        return redirect()->back()->with([
            "success" => 'The device has been enabled',
            "inject_browser_data" => true
        ]);
    }

    public function disable_device(User $user, WebAuthnCredential $credential)
    {
        
        $credential->disable();
        
        $enabled = $credential->where('authenticatable_id',  $user->id)->whereNull('disabled_at')->count();

        if ($enabled == 0) {
            $user->update([
                'enable_biometrics' => false,
            ]);

            return redirect()->back()->with([
                "success" => 'The device has been disabled',
                "clear_browser_data" => true
            ]);
        }



        return redirect()->back()->with("success", 'The device has been disabled');
    }

    public function delete_device(User $user, WebAuthnCredential $credential)
    {
        
        $credential->delete();
        $enabled = $credential->where('authenticatable_id',  $user->id)->where('disabled_at', null)->count();

        if ($enabled == 0) {
            $user->update([
                'enable_biometrics' => false,
            ]);
            return redirect()->back()->with([
                "success" => 'The device has been disabled',
                "clear_browser_data" => true
            ]);
        }


        return redirect()->back()->with("success", 'The device has been disabled');
    }


    /**
     * Display a Login Page Cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function login_page_data(Request $request)
    {
        // dd($request->all());

        $biometric_page = '';



        // return redirect()->back()->with("success", $message);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile_settings()
    {
        if (Auth::user()->role == 'staff') {

            $studentController = new StaffController();
            return $studentController->settings();
        } else if (Auth::user()->role == 'lawyer') {

            $lawyerController = new LawyerController();
            return $lawyerController->settings();
        } else {

            $lawyerController = new AdminController();
            return $lawyerController->profilesettings();
        }
    }

    public function profile()
    {
        // dd('kjhgf');
        if (Auth::user()->role == 'student') {

            $current_rent = DB::table('rents')->where('id',Auth::user()->current_rent)->first();
            $invoice =  DB::table('invoices')->where('application_no', $current_rent->payment_reference)->first();

            
            if (Auth::user()->gender == null  || Auth::user()->level == null || Auth::user()->matric_number == null) {

                return redirect('personal_info');
            } elseif (Auth::user()->g_phone_number == null  || Auth::user()->g_first_name == null) {
                return redirect('guardian_info');
            } elseif (count(DB::table('rents')->where('user_id', Auth::user()->id)->get()) == 0) {
                return redirect('book');
            } elseif($invoice->status != 'successful' || $invoice->payment_status != 'paid'){
                return redirect('purchase/booking/'.$current_rent->id);
            }
            // elseif (count(DB::table('rents')->where('user_id', Auth::user()->id)->get()) < 2 && DB::table('rents')->where('id', auth()->user()->current_rent)->value('school_check_status') != "Approved") {
            //     // return response()->view('auth.await_verification');
            //     // dd(DB::table('rents')->where('id', auth()->user()->current_rent)->value('school_check_status'));
            //     return redirect('await_verification');
            // } 
            else {
                $studentController = new StudentController();
                return $studentController->profile();
            }

            // if (DB::table('rents')->where('user_id', auth()->user()->id)->value('school_check_status') == "Approved") {
            //     $studentController = new StudentController();
            //     return $studentController->profile();
            // } else {
            //     return view('auth.await_verification');
            // }
        }

        if (Auth::user()->role == 'lawyer') {

            $lawyerController = new LawyerController();
            return $lawyerController->profile();
        } else {

            $staffController = new StaffController();
            return $staffController->profile();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());


        $user = User::where('id', Auth::id())->first();

        if ($user->role == 'lawyer') {
            $stamp = $user->lawyer->stamp;
            $signature = $user->lawyer->signature;
        }

        $photo = $user->photo;


        if ($request->stamp || $request->signature || $request->photo) {
            //  dd($request->all());

            request()->validate([
                'stamp' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'signature' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);



            if ($request->signature) {
                $signature_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-signature' . $request->signature->getClientOriginalName());
                $request->signature->storeAs('document-files', $signature_file, 'public_uploads');

                $signature = 'document-files/' . $signature_file;
                $user->lawyer->update([
                    'signature' => $signature,
                ]);
            }




            if ($request->stamp) {

                $stamp_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-stamp' . $request->stamp->getClientOriginalName());
                $request->stamp->storeAs('document-files', $stamp_file, 'public_uploads');


                $stamp = 'document-files/' . $stamp_file;

                $user->lawyer->update([
                    'stamp' => $stamp,
                ]);
            }

            if ($request->photo) {
                $photo_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-photo' . $request->photo->getClientOriginalName());
                $request->photo->storeAs('document-files', $photo_file, 'public_uploads');

                $photo = url('document-files/' . $photo_file);
            }
        }




        // dd($photo);
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'photo' => $photo,
            'phone_number' => $request->phone_number ?? $user->phone_number,
            'street' => $request->address ?? $user->street,
            'city' => $request->city ?? $user->city,
            'state' => $request->state ?? $user->state,
            'company' => $request->company ?? $user->company,
            'inscription' => $request->inscription ?? $user->inscription,
            'office_phone' => $request->office_phone ?? $user->office_phone,
            'note' => $request->note ?? $user->note,
            'note_1' => $request->note_1 ?? $user->note_1,

        ]);


        return redirect()->back()->with("success", "Settings successfully changed!");
    }

    public function update_password(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', Auth::id())->first();

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        if (strcmp($request->confirm_new_password, $request->new_password) != 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "Comfirm password does not match.");
        }

        // $validatedData = $request->validate([
        //     'current_password' => 'required',
        //     'new_password' => 'required|string|min:8|confirmed',
        // ]);

        //Change Password
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        // $user = Auth::user();
        // $user->password = bcrypt($request->get('newPassword'));
        // $user->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/android/i', $u_agent)) {
            $platform = 'android';
        } elseif (preg_match('/ipad/i', $u_agent)) {
            $platform = 'ipad';
        } elseif (preg_match('/blackberry/i', $u_agent)) {
            $platform = 'blackberry';
        } elseif (preg_match('/iphone/i', $u_agent)) {
            $platform = 'iphone';
        } elseif (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
}
