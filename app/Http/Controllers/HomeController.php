<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\BedSpace;
use App\Helpers\BrowserInfo;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use function App\View\Components\send_mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use function App\View\Components\createNotification;


class HomeController extends Controller
{

    use RegistersUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function await_verification()
    {
        if (DB::table('rents')->where('user_id', auth()->user()->id)->value('school_check_status') == "Approved") {
            return redirect('/profile');
        } else {
            return view('auth.await_verification');
        }
    }

    public function get_keys()
    {
        // $paystack_sk = env('PAYSTACK_SECRET_KEY', '');
        $paystack_pk = env('PAYSTACK_PUBLIC_KEY', '');

        return json_encode([
            'paystack_pk' => $paystack_pk,
            // 'paystack_sk' => $paystack_sk,
            'amount' => DB::table('settings')->value('registration_form_price'),
        ]);
    }

    public function new_payment(Request $request)
    {
        return redirect('/create-payment/' . $request->application_no);
    }

    public function change_notification_status(Request $request)
    {
        DB::table('user_notifications')->where('user_id', Auth::user()->id)->update([
            'status' => 'read'
        ]);

        return json_encode([
            'status' => 'success'
        ]);
    }

    public function change_room_type(Request $request)
    {
        $room = DB::table('rooms')->where('id', $request->room_type)->first();
        if ($room) {

            DB::table('rents')->where('id', $request->rent_id)->update([
                'room_id' => $room->id,
                'price' => $room->price,
            ]);

            return redirect()->back()->with('success', 'Process was Successful');
        } else {
            return redirect()->back()->with('error', 'Invalid Details Provided');
        }
    }

    public function call_me_back(Request $request)
    {
        $message =  'Hello Admin';
        $message .=  '<br>';
        $message .=  '<p>' . $request->name . ' has request for a call me back</p>';
        $message .=  '<h4>Details</h4>';
        $message .=  'Name: ' . $request->name . '<br>';
        $message .=  'Email: ' . $request->email . '<br>';
        $message .=  'Phone: ' . $request->phone;
        createNotification('New Call Me Back Request', $request->name, 'has requested for a call me back please check email for details');
        send_mail('Admin', DB::table('settings')->value('reg_email_recipient'), 'New Call Me Back Request', $message);
        return redirect()->back()->with('success', 'We will call you back shortly');
    }

    public function get_rooms_by_locations(Request $request)
    {
        $room_list = ['<option>--Click to select--</option>'];
        //where('room_id', $rent->room_id)->where('user_id', $rent->user_id)->orwhere('room_id', $rent->room_id)->whereNull('user_id')->where('allocated', false)->get()->unique('room_number')
        $rooms = DB::table('rooms')->where('location', $request->location)->where('status', 'available')->where('show_in_site', true)->get();
        // $rooms = $bedSpace = BedSpace::where('room_id', $request->room_id)->where('room_number', $request->room_number)->where('user_id', $request->user_id)->orWhere('room_id', $request->room_id)->where('room_number', $request->room_number)->whereNull('user_id')->where('allocated', false)->get();

        foreach ($rooms as $room) {
            $bedSpace = BedSpace::where('room_id', $room->id)->whereNull('user_id')->where('allocated', false)->get()->count();

            if ($bedSpace > 0) {
                $room_list[] = '<option value="' . $room->id . '">' . $room->name . '</option>';
            }
        }
        if (count($room_list) > 1) {
            return json_encode([
                'status' => 'success',
                'room_list' => $room_list,
                //    'current' => $sortbyRoom ?? '',
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'Oops! No Room Unavailable for the selected Location',
                'room_list' => '<option>--Sorry! No Room Unavailable--</option>',
                //    'current' => $sortbyRoom ?? '',
            ]);
        }
    }

    public function send_payment_info(Request $request)
    {
        $application_no = $request->application_no;

        // dd($request->all());
        $sender_details = json_encode($request->except('_token'));
        $original_amount = $request->original_amount ??  DB::table('invoices')->where('application_no', $application_no)->value('amount');

        $done = DB::table('invoices')->where('application_no', $application_no)->update([
            'sender_details' => $sender_details,
            // 'original_amount' => $original_amount,
            'payment_status' => 'incomplete',
            'payment_method' => 'Bank Transfer',
            'updated_at' => Carbon::now(),
        ]);


        if ($done) {
            return redirect()->back()->with('success', 'Your details has been submitted we will get back to your via Email');
        } else {
            return redirect()->back()->with('error', 'We encounter an error, please refresh this page and try again');
        }
    }

    public function admin_login(Request $request)
    {
        return view('auth.admin_login');
    }

    public function send_contact_mail(Request $request)
    {

        send_mail('Admin', DB::table('settings')->value('reg_email_recipient'), 'Contact Mail', $request->input('message') . ' ' . 'from: ' . $request->input('name') . ' ' . $request->input('email'));

        return back();
    }

    public function get_room_by_id(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $bed_space_list = '';
        $room_details = DB::table('rooms')->where('id', $request->id)->where('status', 'available')->where('show_in_site', true)->first();
        // $rooms = $bedSpace = BedSpace::where('room_id', $request->room_id)->where('room_number', $request->room_number)->where('user_id', $request->user_id)->orWhere('room_id', $request->room_id)->where('room_number', $request->room_number)->whereNull('user_id')->where('allocated', false)->get();
        $room_location = DB::table('locations')->where('id', $room_details->location)->value('name');

        $bedSpaces = BedSpace::where('room_id', $room_details->id)->whereNull('user_id')->where('allocated', false)->get();

        $current_rent = $user->current_rent ? DB::table('rents')->where('id', $user->current_rent)->first() : '';

        foreach ($bedSpaces as $bedSpace) {
            if (isset($current_rent->bed_space)) {
                $currentBedSpace = BedSpace::where('room_id', $room_details->id)->where('id', $current_rent->bed_space)->first();
                if ($currentBedSpace) {
                    $bed_space_list .= '<option value="' . $currentBedSpace->id . '" selected>' . $currentBedSpace->room_number . ' - ' . $currentBedSpace->name . '</option>';
                }
            }
            $bed_space_list .= '<option value="' . $bedSpace->id . '">' . $bedSpace->room_number . ' - ' . $bedSpace->name . '</option>';
        }

        //   $room_amenities = DB::table('amenities')->where('id', $room_details->location)->value('name');

        $room_amenities = $room_details->amenity1 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity1)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity2 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity2)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity3 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity3)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity4 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity4)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity5 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity5)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity6 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity6)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity7 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity7)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity8 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity8)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity9 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity9)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room_details->amenity10 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room_details->amenity10)->value('name') . '</span></div></div>' : '';

        return json_encode([
            'status' => 'success',
            'room_details' => $room_details,
            'room_location' => $room_location ?? '',
            'room_amenities' => $room_amenities ?? '',
            'bed_space_list' => $bed_space_list ?? '',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    // public function index()
    // {
    //     return view('index');
    // }
    public function index()
    {
        return view('pages.home-page.index');
    }
    public function about()
    {
        return view('pages.home-page.about');
    }
    public function contacts()
    {
        return view('pages.home-page.contacts');
    }
    public function locations()
    {
        return view('pages.home-page.locations');
    }

    public function product_page()
    {
        return view('pages.home-page.products');
    }

    public function home()
    {


        $user = User::find(auth()->user()->id);
        if ($user->role == 'student') {
            if (!empty(DB::table('rents')->where('id', auth()->user()->current_rent)->value('expiring_date')) && DB::table('rents')->where('id', auth()->user()->current_rent)->value('expiring_date') < \Carbon\Carbon::now()) {
                return redirect('profile')->with('error', 'Your rent has expired, Check Rents to book a new Room');
            } else {
                return redirect('profile')->with([
                    'new_login' => 'YES',
                    // 'success' => 'Login Successful',            
                ]);
            }
            // return redirect('profile');
        } else {

            User::find(auth()->user()->id);
            if ($user->can('view-dashboard')) {
                return redirect('dashboard')->with([
                    // 'success' => 'Login Successful',
                    // 'new_login' => 'YES'
                ]);
            } else {

                return redirect('profile')->with([
                    // 'success' => 'Login Successful',
                    // 'new_login' => 'YES'
                ]);
            }
        }
    }

    public function productPage()
    {


        return view('product-page');
    }

    public function create_invoice(Request $request)
    {

        $amount = DB::table('rents')->where('id', $request->rent_id)->value('price');
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $application_no = strtoupper(substr($random, 0, 8));

        if ($room = DB::table('rents')->where('id', $request->rent_id)->get()) {

            $invoice = DB::table('invoices')->insert([
                'full_name' => Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name,
                'application_no' => $application_no,
                'amount' =>  $amount,
                'email' => Auth::user()->email,
                'year' =>  DB::table('settings')->value('current_year'),
                'phone_number' => Auth::user()->phone_number,
                'type' => $request->type
            ]);

            if ($invoice) {
                DB::table('rents')->where('id', $request->rent_id)->update([
                    'payment_reference' => $application_no,
                ]);
            }


            createNotification('New Invoice', Auth::user()->first_name, 'Just Created an Invoice for ' . ucwords($request->type));


            return json_encode([
                'status' => 'success',
                'message' => 'Invoice created successfully',
                'application_no' => $application_no
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'Can not access rent details',
            ]);
        }
    }

    public function get_invoice($application_no)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $transaction_id = strtoupper(substr($random, 0, 12));
        $invoice = DB::table('invoices')->where('application_no', $application_no)->first();
        $invoice->transaction_id = $transaction_id;
        if ($invoice) {
            return json_encode([
                'status' => 'success',
                // 'message' => 'Invoice created successfully',
                'invoice' => $invoice
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'Can not access rent details',
            ]);
        }
    }

    public function application_setup(Request $request)
    {

        // dd($request->all());
        Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'digits:11', 'unique:users'],
            //'password' => ['required', 'string', 'min:5', 'confirmed'],

        ])->validate();

        $amount = DB::table('settings')->value('registration_form_price');
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $application_no = strtoupper(substr($random, 0, 8));

        $firstname = '';
        $middlename = '';
        $lastname = '';

        $parts = explode(' ', $request->full_name);
        if (count($parts) === 2) {
            list($firstname, $lastname) = $parts;
        } else if (count($parts) === 3) {
            list($firstname, $middlename, $lastname) = $parts;
        }
        if (count($parts) === 1) {
            $firstname = $request->full_name;
            $lastname = 'Uname';
        }
        $payment_data = json_encode([
            'referral_code' => $request->referral_code,
        ]);

        DB::table('invoices')->insert([
            'full_name' => $request->full_name,
            'application_no' => $application_no,
            'amount' =>  $amount,
            'email' => $request->email,
            'payment_data' => $payment_data,
            'year' =>  DB::table('settings')->value('current_year'),
            'phone_number' => $request->phone_number,
            'type' => 'Registration Form'
        ]);

        createNotification('New Invoice', $firstname, 'Just Created an Invoice for registration form');

        return redirect('/application/' . $application_no);
    }

    public function confirm_online_payment($transaction_id, Request $request)
    {

        $application_no = $request->application_no;

        try {
            $client = new Client();
            $response = $client->get('https://api.paystack.co/transaction/verify/' . rawurlencode($transaction_id), [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY', ''),
                    'accept' => 'application/json',
                    'cache-control' => 'no-cache'
                ],
            ]);

            $data = json_decode($response->getBody());
            $data->data->transaction_id = $transaction_id;



            // DB::table('invoices')->where('transaction_id', $transaction_id)->first()
            if (!$data->status) {
                // there was an error from the API
                return json_encode([
                    'status' => 'error',
                    'message' => 'API returned error: ' . $data->message,
                    'application_no' => '',
                ]);
                // return redirect()->back()->with('error', 'API returned error: ' . $data->message);

                // die('API returned error: ' . $data->message);
            }

            if ('success' == $data->data->status) {
                // transaction was successful...

                $user_email = $data->data->customer->email;
                $user = DB::table('users')->where('email', $user_email)->first();

                $rent = DB::table('rents')->where('id', $user->current_rent)->first();

                $invoice = DB::table('invoices')->where('application_no', $application_no)->first();

                //$invoice->amount

                if ($data->data->amount >= $invoice->amount) {
                    // transaction was successful...

                    DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                        'payment_data' =>  json_encode($data->data),
                        'payment_status' => 'paid',
                        'payment_method' => 'Online Payment',
                        'status' => 'successful',
                        'user_id' => $user->id,
                        'transaction_id' =>  $transaction_id,
                    ]);

                    return json_encode([
                        'status' => 'success',
                        'message' => 'Payment Successfull',
                        'application_no' => $invoice->application_no,
                    ]);
                } elseif ($data->data->amount < $invoice->amount) {

                    DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                        'payment_data' =>  json_encode($data->data),
                        'payment_status' => 'incomplete',
                        'payment_method' => 'Online Payment',
                        'transaction_id' =>  $transaction_id,
                        'user_id' => $user->id,
                    ]);

                    return json_encode([
                        'status' => 'warning',
                        'message' => 'The Amount You Paid is not upto the required amount please contact our sales manager for help',
                        'application_no' => $invoice->application_no,
                    ]);
                    // return redirect()->back()->with('warning', 'The Amount You Paid is not upto the required amount please contact our sales manager for help');
                } else {

                    DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                        'payment_data' =>  json_encode($data->data),
                        'payment_status' => 'unresolved',
                        'payment_method' => 'Online Payment',
                        'transaction_id' =>  $transaction_id,
                        'user_id' => $user->id,

                    ]);
                    return json_encode([
                        'status' => 'warning',
                        'message' => 'Payment successfull but we encounter an error during processing data please contact our sales manager for help',
                        'application_no' => $invoice->application_no,
                    ]);
                    // return redirect()->back()->with('error', 'Payment successfull but we encounter an error during processing data please contact our sales manager for help');
                }
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {

            // dd($e->getResponse()->getStatusCode());
            return json_encode([
                'status' => 'error',
                'message' => 'Can not reach payment server!! Time Out',
                // 'application_no' => $invoice->application_no,
            ]);
            // return redirect()->back()->with('error', 'Can not reach payment server!! Time Out,');
            error_log($e);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                    $status = $response->getStatusCode();
                    $message = $response->getReasonPhrase();
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Sorry an Error occured with status ' . $status . ': ' . $message,
                        // 'application_no' => $invoice->application_no,
                    ]);
                    // return redirect()->back()->with('error', 'Sorry an Error occured with status ' . $status . ': ' . $message);
                    error_log($e);
                }
            }
            // dd($e->getResponse()->getStatusCode());
            return json_encode([
                'status' => 'error',
                'message' => 'Sorry an Unknown Error occured!!',
                // 'application_no' => $invoice->application_no,
            ]);
            // return redirect()->back()->with('error', 'Sorry an Unknown Error occured!!,');
            error_log($e);
        }
    }

    public function confirm_bank_transfer($transaction_id)
    {


        // $transaction_id = $transaction_id;
        // $transaction_type = $request->type;
        // $transaction_id = $request->reference;
        // $success = false;
        // $type = $request->type;

        $user_id = Auth::id();

        if (DB::table('invoices')->where('transaction_id', $transaction_id)->first()) {
            return json_encode([
                'status' => 'error',
                'message' => 'Transaction ID has been used!',
                // 'application_no' => $invoice->application_no,
            ]);
        } elseif ($manual_payment = DB::table('manual_payment')->where('transaction_id', $transaction_id)->where('type', 'bank')->first()) {

            $invoice = DB::table('invoices')->where('application_no', $manual_payment->application_no)->first();

            // $manual_payment->transaction_id = $transaction_id;

            if ($manual_payment->amount >= $invoice->amount) {
                // transaction was successful...

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'paid',
                    'payment_method' => 'Bank Transfer',
                    'status' => 'successful',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,
                ]);
                return json_encode([
                    'status' => 'success',
                    'message' => 'Congratulation your payment has been confirmed',
                    'application_no' => $invoice->application_no,
                ]);
            } elseif ($manual_payment->amount < $invoice->amount) {

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'incomplete',
                    'payment_method' => 'Bank Transfer',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,

                ]);

                return json_encode([
                    'status' => 'error',
                    'application_no' => $invoice->application_no,
                    'message' => 'The Amount You Paid is not upto the required amount please contact our sales manager for help',
                ]);
            } else {

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'unresolved',
                    'payment_method' => 'Bank Transfer',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,

                ]);

                return json_encode([
                    'status' => 'error',
                    'application_no' => $invoice->application_no,
                    'message' => 'Payment successfull but we encounter an error during processing data please contact our sales manager for help',
                ]);
            }
        } else {
            return json_encode([
                'status' => 'error',
                'application_no' => 'null',
                'message' => 'Invalid Transaction ID',
            ]);
        }
    }


    public function confirm_direct_payment($transaction_id)
    {


        // $transaction_id = $transaction_id;
        // $transaction_type = $request->type;
        // $transaction_id = $request->reference;
        // $success = false;
        // $type = $request->type;


        $user_id = Auth::id();
        $m_payment = DB::table('manual_payment')->where('transaction_id', $transaction_id)->where('type', 'direct')->first();
        $rent = DB::table('rents')->where('payment_reference', $m_payment->application_no)->first();

        if (DB::table('invoices')->where('transaction_id', $transaction_id)->first()) {

            return redirect('/booking/' . $rent->id)->with('error', 'Transaction ID has been used!');
        } else if ($manual_payment = DB::table('manual_payment')->where('transaction_id', $transaction_id)->where('type', 'direct')->first()) {

            $invoice = DB::table('invoices')->where('application_no', $manual_payment->application_no)->first();

            $manual_payment->transaction_id = $transaction_id;

            if ($manual_payment->amount >= $invoice->amount) {
                // transaction was successful...

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'paid',
                    'payment_method' => 'Bank Transfer',
                    'status' => 'successful',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,
                ]);

                return redirect('/booking/' . $rent->id)->with('success', 'Congratulation your payment has been confirmed');
            } elseif ($manual_payment->amount < $invoice->amount) {

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'incomplete',
                    'payment_method' => 'Bank Transfer',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,

                ]);

                return redirect('/booking/' . $rent->id)->with('error', 'The Amount You Paid is not upto the required amount please contact our sales manager for help');
                // return json_encode([
                //     'status' => 'error',
                //     'application_no' => $invoice->application_no,
                //     'message' => 'The Amount You Paid is not upto the required amount please contact our sales manager for help',
                // ]);

            } else {

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'payment_data' =>  $manual_payment->payment_data,
                    'payment_status' => 'unresolved',
                    'payment_method' => 'Bank Transfer',
                    'user_id' =>  $user_id,
                    'transaction_id' =>  $transaction_id,

                ]);

                return redirect('/booking/' . $rent->id)->with('error', 'Payment successfull but we encounter an error during processing data please contact our sales manager for help');

                // return json_encode([
                //     'status' => 'error',
                //     'application_no' => $invoice->application_no,
                //     'message' => 'Payment successfull but we encounter an error during processing data please contact our sales manager for help',
                // ]);
            }
        } else {
            return redirect('/booking/' . $rent->id)->with('error', 'Invalid Transaction ID');
            // return json_encode([
            //     'status' => 'error',
            //     'application_no' => 'null',
            //     'message' => 'Invalid Transaction ID',
            // ]);
        }
    }


    public function confirm_payment(Request $request)
    {


        $application_no = $request->application_no;
        $transaction_type = $request->type;
        $transaction_id = $request->reference;
        $success = false;

        $invoice = DB::table('invoices')->where('application_no', $application_no)->first();

        if ($invoice) {
            if ($transaction_type === 'online_payment') {
                try {
                    $client = new Client();
                    $response = $client->get('https://api.paystack.co/transaction/verify/' . rawurlencode($transaction_id), [
                        'headers' => [
                            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY', ''),
                            'accept' => 'application/json',
                            'cache-control' => 'no-cache'
                        ],
                    ]);

                    $data = json_decode($response->getBody());
                    $data->data->transaction_id = $transaction_id;
                    if (!$data->status) {
                        // there was an error from the API
                        return redirect()->back()->with('error', 'API returned error: ' . $data->message);

                        // die('API returned error: ' . $data->message);
                    }

                    if ('success' == $data->data->status) {
                        // transaction was successful...
                        if ($data->data->amount >= DB::table('settings')->value('registration_form_price')) {
                            // transaction was successful...

                            DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                                'payment_data' =>  json_encode($data->data),
                                'payment_status' => 'paid',
                                'payment_method' => 'Online Payment',
                                'status' => 'successful',
                                // 'transaction_id' =>  $transaction_id,
                            ]);
                            // $messages = '';
                            $success = true;
                            // dd($data);
                        } elseif ($data->data->amount < DB::table('settings')->value('registration_form_price')) {

                            DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                                'payment_data' =>  json_encode($data->data),
                                'payment_status' => 'incomplete',
                                'payment_method' => 'Online Payment',
                                // 'transaction_id' =>  $transaction_id,

                            ]);
                            return redirect()->back()->with('warning', 'The Amount You Paid is not upto the required amount please contact our sales manager for help');
                        } else {

                            DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                                'payment_data' =>  json_encode($data->data),
                                'payment_status' => 'unresolved',
                                'payment_method' => 'Online Payment',
                                // 'transaction_id' =>  $transaction_id,

                            ]);
                            return redirect()->back()->with('error', 'Payment successfull but we encounter an error during processing data please contact our sales manager for help');
                        }
                    }
                } catch (\GuzzleHttp\Exception\ConnectException $e) {

                    // dd($e->getResponse()->getStatusCode());
                    return redirect()->back()->with('error', 'Can not reach payment server!! Time Out,');
                    error_log($e);
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    if ($e->hasResponse()) {
                        if ($e->hasResponse()) {
                            $response = $e->getResponse();
                            $status = $response->getStatusCode();
                            $message = $response->getReasonPhrase();
                            return redirect()->back()->with('error', 'Sorry an Error occured with status ' . $status . ': ' . $message);
                            error_log($e);
                        }
                    }
                    // dd($e->getResponse()->getStatusCode());
                    return redirect()->back()->with('error', 'Sorry an Unknown Error occured!!,');
                    error_log($e);
                }
            } elseif ($transaction_type === 'bank_transfer') {


                if (DB::table('invoices')->where('transaction_id', $transaction_id)->first()) {
                    return redirect()->back()->with('warning', 'Transaction ID has been used!');
                } else if ($manual_payment = DB::table('manual_payment')->where('transaction_id', $transaction_id)->where('type', 'bank')->first()) {


                    $manual_payment->transaction_id = $transaction_id;
                    if ($manual_payment->amount >= DB::table('settings')->value('registration_form_price')) {
                        // transaction was successful...

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'paid',
                            'payment_method' => 'Bank Transfer',
                            'status' => 'successful',
                            // 'transaction_id' =>  $transaction_id,
                        ]);
                        // $messages = '';
                        $success = true;
                        // dd($data);
                        // dd($manual_payment);
                    } elseif ($manual_payment->amount < DB::table('settings')->value('registration_form_price')) {

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'incomplete',
                            'payment_method' => 'Bank Transfer',
                            // 'transaction_id' =>  $transaction_id,

                        ]);
                        return redirect()->back()->with('warning', 'The Amount You Paid is not upto the required amount please contact our sales manager for help');
                    } else {

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'unresolved',
                            'payment_method' => 'Bank Transfer',
                            // 'transaction_id' =>  $transaction_id,

                        ]);
                        return redirect()->back()->with('error', 'Payment successfull but we encounter an error during processing data please contact our sales manager for help');
                    }
                } else {
                    return redirect()->back()->with('error', 'Invalid Transaction ID');
                }
            } elseif ($transaction_type === 'direct_payment') {



                if ($invoice = DB::table('invoices')->where('transaction_id', $transaction_id)->first()) {
                    return redirect()->back()->with('warning', 'Transaction ID has been used!');
                } else if ($manual_payment = DB::table('manual_payment')->where('transaction_id', $transaction_id)->where('type', 'direct')->first()) {


                    $manual_payment->transaction_id = $transaction_id;
                    if ($manual_payment->amount >= DB::table('settings')->value('registration_form_price')) {
                        // transaction was successful...

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'paid',
                            'payment_method' => 'Direct Payment',
                            'status' => 'successful',
                            // 'transaction_id' =>  $transaction_id,

                        ]);

                        $success = true;
                    } elseif ($manual_payment->amount < DB::table('settings')->value('registration_form_price')) {

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'incomplete',
                            'payment_method' => 'Direct Payment',
                            // 'transaction_id' =>  $transaction_id,

                        ]);

                        return redirect('/application/' . $invoice->application_no)->with('warning', 'The Amount You Paid is not upto the required amount please contact our sales manager for help');
                    } else {

                        DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                            'payment_data' =>  $manual_payment->payment_data,
                            'payment_status' => 'unresolved',
                            'payment_method' => 'Direct Payment',
                            // 'transaction_id' =>  $transaction_id,

                        ]);
                        return redirect('/application/' . $invoice->application_no)->with('error', 'Payment successfull but we encounter an error during processing data please contact our sales manager for help');
                    }
                } else {
                    return redirect('/application/' . $invoice->application_no)->with('error', 'Invalid Transaction ID');
                }
            }

            if ($success == true) {
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

                $password = 'pass' . substr($random, 0, 6);
                $user = User::create([
                    'first_name' => $firstname,
                    'middle_name' => $middlename,
                    'last_name' =>  $lastname,
                    'email' => $invoice->email,
                    'year' =>  DB::table('settings')->value('current_year'),
                    'phone_number' => $invoice->phone_number,
                    'password' => Hash::make($password),
                    'application_form_number' => $invoice->application_no,
                    'verification_code' => $code,
                    'email_verified_at' => Carbon::now(),
                ]);

                DB::table('invoices')->where('application_no', $invoice->application_no)->update([
                    'user_id' =>  $user->id,
                    'transaction_id' =>  $transaction_id,

                ]);

                $auth = '<h4>Login Details</h4>';
                $auth .= '<br>Email: ' . $invoice->email;
                $auth .= '<br>Password: ' . $password;

                $link = url('/profile');
                $input = ['[full_name]', '[transaction_id]', '[link]', '[type]', '[auth]'];
                $outfilled = [$invoice->full_name, $transaction_id, $link ?? '', $invoice->type, $auth];
                $message =  str_replace($input, $outfilled,  DB::table('settings')->value('manual_payment_confirmation_message'));


                send_mail($invoice->full_name, $invoice->email, 'Registration Form Payment', $message);
                createNotification('New Registration', $firstname, 'Registered an Account');


                event(new Registered($user));

                $this->guard()->login($user);

                if ($response = $this->registered($request, $user)) {
                    return $response;
                }

                return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());


                return redirect('/profile')->with('success', 'Transaction Successfull');
            } else {
                return redirect('/application/' . $invoice->application_no)->with('error', 'Invalid Transaction');
            }
        } else {
            return redirect('/application/' . $application_no)->with('error', 'Invalid Invoice Number');
        }
    }

    public function application($application_no)
    {

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $transaction_id = strtoupper(substr($random, 0, 12));


        $applicant = DB::table('invoices')->where('application_no', $application_no)->first();
        $applicant->amount = DB::table('settings')->value('registration_form_price');
        $applicant->transaction_id = $transaction_id;
        return view('auth.form-application-process')->with('applicant', $applicant);
    }
}