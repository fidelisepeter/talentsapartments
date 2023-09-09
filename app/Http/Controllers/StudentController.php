<?php

namespace App\Http\Controllers;

use Complains;
use Carbon\Carbon;
use App\Models\Rent;
use App\Models\User;
use App\Models\Promo;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use function App\View\Components\sendPdf;

use Illuminate\Support\Facades\Validator;
use function App\View\Components\send_mail;
use function App\View\Components\sendGurantorForm;
use function App\View\Components\createNotification;

class StudentController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth', 'is.verified']);
    // }


    public function user_details($id)
    {

        if ($user = User::where('ta_uid', $id)->orwhere('id', $id)->first()) {
            // $user = DB::table('users')->where('id',Auth::user()->id)->first();
            $rents = DB::table('rents')->where('user_id', $user->id)->orderByDesc('id')->limit(2)->get();
            $last_rent = DB::table('rents')->where('user_id', $user->id)->orderByDesc('id')->first();
            $current_rent = DB::table('rents')->where('id',  $user->current_rent)->first();

            $get_room = BedSpace::where('id', $current_rent->bed_space ?? 00000)->first();
            $cht = "qr";
            $chs = "300x300";
            $chl = url('/user-details/' . $user->ta_uid ?? $user->id);
            $choe = "UTF-8";
            $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

            //  $last_room = DB::table('rooms')->where('id',$last_rent->room_id)->first();
            return view('pages.user-details')->with(['user' => $user, 'last_rent' => $last_rent, 'qrcode' => $qrcode, 'rents' => $rents,  'bed_space' => $get_room]);
        } else {
            return view('pages.user-not-found');
        }
    }


    public function profile()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $rents = DB::table('rents')->where('user_id', Auth::user()->id)->orderByDesc('id')->limit(2)->get();
        $last_rent = DB::table('rents')->where('user_id', Auth::user()->id)->orderByDesc('id')->first();
        $current_rent = DB::table('rents')->where('id',  $user->current_rent)->first();

        $get_room = BedSpace::where('id', $current_rent->bed_space ?? 00000)->first();
        $cht = "qr";
        $chs = "300x300";
        $chl = url('/user-details/' . $user->ta_uid ?? $user->id);
        $choe = "UTF-8";
        $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

        //  $last_room = DB::table('rooms')->where('id',$last_rent->room_id)->first();
        return view('pages.profile')->with(['user' => $user, 'last_rent' => $last_rent, 'qrcode' => $qrcode, 'rents' => $rents,  'bed_space' => $get_room]);
    }

    public function billings()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $rents = DB::table('rents')->where('user_id', Auth::user()->id)->orderByDesc('id')->limit(2)->get();
        $last_rent = DB::table('rents')->where('user_id', Auth::user()->id)->orderByDesc('id')->first();
        $current_rent = DB::table('rents')->where('id',  $user->current_rent)->first();

        $get_room = BedSpace::where('id', $current_rent->bed_space ?? 00000)->first();
        $cht = "qr";
        $chs = "300x300";
        $chl = url('/user-details/' . $user->ta_uid ?? $user->id);
        $choe = "UTF-8";
        $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

        //  $last_room = DB::table('rooms')->where('id',$last_rent->room_id)->first();
        return view('pages.billings')->with(['user' => $user, 'last_rent' => $last_rent, 'qrcode' => $qrcode, 'rents' => $rents,  'bed_space' => $get_room]);
    }

    public function room_mate_code(Request $request)
    {

        if ($user = DB::table('users')->whereNotNull('verification_code')->where('verification_code', $request->verification_code)->where('id', '!=', Auth::id())->first()) {

            if (DB::table('rents')->whereNotNull('room_mate_code')->where('room_mate_code', $request->verification_code)->first()) {
                return redirect('/profile')->with('error', 'Sorry! user already have a pending room mate');
            } else {
                DB::table('rents')->where('id', Auth::user()->current_rent)->update([
                    'room_mate_code' => $request->verification_code
                ]);
                return redirect('/profile')->with('success', 'code authenticated');
            }
        } else {
            return redirect('/profile')->with('error', 'Can not authenticate code - CODEERROR');
        }
    }


    public function room()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $last_rent = DB::table('rents')->where('user_id', Auth::user()->id)->orderByDesc('id')->first();
        $current_rent = DB::table('rents')->where('id',  $user->current_rent)->first();
        $get_room = BedSpace::where('id', $current_rent->bed_space ?? 000)->first();
        $room = $get_room->room ?? [];
        // $user->qrcode = url('/user-details/'.$user->id);
        $cht = "qr";
        $chs = "300x300";
        $chl = url('/resident-info/' . $user->id);
        $choe = "UTF-8";
        $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

        //  $last_room = DB::table('rooms')->where('id',$last_rent->room_id)->first();
        //   dd($room);
        if ($get_room && $current_rent->status == 'Approved') {
            return view('pages.user-room')->with(['user' => $user, 'last_rent' => $last_rent, 'current_rent' => $current_rent, 'room' => $room, 'bed_space' => $get_room]);
        } else {
            return redirect('/profile')->with('error', 'You cant view that page right now');
        }
    }


    public function personal_info()
    {

        return view('auth.personal_info');
    }


    public function guardian_info()
    {

        return view('auth.guardian_info');
    }


    public function update_personal_info(Request $request)
    {

        request()->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $photo =  Auth::user()->photo;

        if ($files = $request->file('photo')) {
            // $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();
            // $photo = $response;
            $filesName = 'user-' . Auth::id() . '-picture-file-' . $request->file->hashName();
            $request->file->storeAs('users-files', $filesName, 'public_uploads');
            $photo = url('/users-files/' . $filesName);
        }
        DB::table('users')->where('id', Auth::user()->id)->update([
            'first_name' => $request->input('first_name') ?? Auth::user()->first_name,
            'last_name' => $request->input('last_name') ?? Auth::user()->last_name,
            'middle_name' => $request->input('middle_name') ?? Auth::user()->middle_name,
            'photo' => $photo,
            // 'dob' =>$request->input('dob'),
            // 'gender' =>$request->input('gender'),
            // 'school' =>$request->input('school'),
            // 'street' =>$request->input('sreet'),
            // 'city' => $request->input('city'),
            // 'state' =>$request->input('state'),
            // 'level' =>$request->input('level'),
            // 'course' =>$request->input('course'),
            // 'department' =>$request->input('department'),
            // 'faculty'=>$request->input('faculty'),
            // 'matric_number'=>$request->input('matric'),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    //users first step

    public function save_personal_info(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //           'room' => 'required',
        //         ]);


        Validator::make($request->all(), [
            'room' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'street' => 'required',
            'state' => 'required',
            'school' => 'required',
            'level' => 'required',
            'course' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'admission_letter' => 'required|file|mimes:pdf',
            'matric_number' => 'required|string|unique:users',
        ])->validate();


        $admission_letter = NULL;
        if ($files = $request->file('admission_letter')) {

            $filesName = 'user-' . Auth::id() . '-admission-letter-file-' . $request->admission_letter->hashName();

            $request->admission_letter->storeAs('users-files', $filesName, 'public_uploads');

            // Storage::disk('public_uploads')->put('users-files', $request->file);

            // $response = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();

            $admission_letter = url('/users-files/' . $filesName);
        }


        $promo = Promo::where('promo_code', $request->input('promo_code'))->first();
        $room = DB::table('rooms')->where('id', $request->input('room'))->first();
        $promo_data = null;
        if (!empty($promo)) {

            $room_data = json_decode($promo->promo_data, true);
            if ($promo->promo_type == 'special') {
                if ($room_data['room_id'] == $request->input('room')) {
                    $percentage_off = $room_data['percentage_off'];
                }
            } elseif ($promo->promo_type == 'regular') {
                foreach ($room_data as $value) {
                    if ($value['room_id'] == $request->input('room')) {
                        $percentage_off = $value['percentage_off'];
                    }
                }
            }

            $cal_percentage_off = ($room->price / 100) * $percentage_off;
            $discount_price = ($room->price - $cal_percentage_off);


            $promo_data = json_encode([
                'room_id' => $room->id,
                'percentage_off' => $percentage_off,
            ]);
        }
        // dd($percentage_off);



        $insertLastId = DB::table('rents')->insertGetId([
            'user_id' => Auth::user()->id,
            'room_id' => $request->input('room'),
            'price' => $discount_price ?? DB::table('rooms')->where('id', $request->input('room'))->value('price'),
            'original_price' => DB::table('rooms')->where('id', $request->input('room'))->value('price'),
            'status' => 'pending',
            'referral_code' => User::where('id', Auth::user()->referrer)->value('referral_code'),
            'promo_code' => $request->input('promo_code') ?? null,
            'promo_data' => $promo_data,
            'updated_at' => Carbon::now(),
            'year' => DB::table('settings')->value('current_year'),
        ]);



        if ($insertLastId) {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'jaja_number' => $request->input('jaja_number'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'school' => $request->input('school'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'level' => $request->input('level'),
                'course' => $request->input('course'),
                'department' => $request->input('department'),
                'faculty' => $request->input('faculty'),
                'matric_number' => $request->input('matric_number'),
                'current_rent' => $insertLastId,
                'admission_letter' => $admission_letter,
                'g_relationship' => $request->input('g_relationship'),
                'g_suffix' => $request->input('g_suffix'),
                'g_first_name' => $request->input('g_first_name'),
                'g_last_name' => $request->input('g_last_name'),
                'g_email' => $request->input('g_email'),
                'g_phone_number' => $request->input('g_phone_number'),
                'g_street' => $request->input('g_street'),
                'g_state' => $request->input('g_state'),
                'updated_at' => Carbon::now(),
            ]);
        }


        // dd($request->all());
        // return redirect('guardian_info');
        return redirect('purchase/booking/' . $insertLastId);
    }
    public function booking_renew($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        $user_id = $rent->user_id;

        return view('pages.booking-renewal')->with(['main_rent' => $rent]);
    }
    public function renew_booking(Request $request, $id)
    {

        $rent = DB::table('rents')->where('id', $id)->first();
        $room = DB::table('rooms')->where('id', $request->input('room'))->first();

        $insertLastId = DB::table('rents')->insertGetId([
            'user_id' => Auth::user()->id,
            'previous_rent' => $rent->id,
            'type' => 'renewal',
            'room_id' => $request->input('room'),
            'price' => $room->price,
            'original_price' => $room->price,
            'status' => 'pending',
            'change_room' => $request->input('room') != $room->id ? true : false,
            'school_check_status' => $rent->school_check_status,
            'guarantor_letter_photo' => $rent->guarantor_letter_photo,
            'guarantor_letter_status' => $rent->guarantor_letter_status,
            'health_check_photo' => $rent->health_check_photo,
            'health_check_status' => $rent->health_check_status,
            'attestation_letter_photo' => $rent->attestation_letter_photo,
            'attestation_letter_status' => $rent->attestation_letter_status,
            'updated_at' => Carbon::now(),
            'year' => DB::table('settings')->value('current_year'),
        ]);

        //send mail to admin
        //  $input = ['[first_name]', '[middle_name]', '[last_name]'];
        // $outfilled = [Auth::user()->first_name, Auth::user()->middle_name, Auth::user()->last_name];
        // $message =  str_replace($input, $outfilled,  DB::table('settings')->value('application_recieved_message'));

        //  $settings = DB::table('settings')->first();
        //  send_mail('Admin', $settings->reg_email_recipient, 'Talents Apartment Application', $message);

        return redirect()->back()->with('success', 'Renewal Sent and waiting for aproval');
    }

    public function pay_booking(Request $request, Rent $rent)
    {
        // dd($rent);
        $amount = $rent->price;
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $application_no = strtoupper(substr($random, 0, 8));

        $invoice = DB::table('invoices')->where('application_no', $rent->payment_reference)->first();
        if ($invoice == null) {
            $invoice = DB::table('invoices')->insert([
                'full_name' => Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name,
                'application_no' => $application_no,
                'amount' =>  $amount,
                'email' => Auth::user()->email,
                'year' =>  DB::table('settings')->value('current_year'),
                'phone_number' => Auth::user()->phone_number,
                'type' => 'Rent Booking'
            ]);

            if ($invoice) {

                DB::table('rents')->where('id', $rent->id)->update([
                    'payment_reference' => $application_no,
                ]);
            }
            createNotification('New Invoice', Auth::user()->first_name, 'Just Created an Invoice for ' . ucwords($request->type));
        }

        if ($invoice->status != 'successful' || $invoice->payment_status != 'paid') {
            return view('auth.booking-payment')->with(compact(['rent', 'invoice']));
        } else {
            if ($rent->proof_status == 'Approved') {
                $message = 'Your payment is successful! please continue uploading the required document';
            } else {
                $message = 'Your payment is successful and waiting for approval';
            }
            return redirect('booking/' . $rent->id)->with('success', $message);
        }


        // return json_encode([
        //     'status' => 'success',
        //     'message' => 'Invoice created successfully',
        //     'application_no' => $application_no
        // ]);

    }

    public function save_guardian_info(Request $request)
    {

        DB::table('users')->where('id', Auth::user()->id)->update([
            'g_relationship' => $request->input('g_relationship'),
            'g_suffix' => $request->input('g_suffix'),
            'g_first_name' => $request->input('g_first_name'),
            'g_last_name' => $request->input('g_last_name'),
            'g_email' => $request->input('g_email'),
            'g_phone_number' => $request->input('g_phone_number'),
            'g_street' => $request->input('g_street'),
            'g_state' => $request->input('g_state'),
            'updated_at' => Carbon::now(),
        ]);

        //send mail to users
        // $link = url('/booking/'.$rent->id);


        $input = ['[first_name]', '[middle_name]', '[last_name]'];
        $outfilled = [Auth::user()->first_name, Auth::user()->middle_name, Auth::user()->last_name];
        $message =  str_replace($input, $outfilled,  DB::table('settings')->value('application_recieved_message'));

        // send_mail($invoice->full_name, $invoice->email, 'Rent Booking Payment', $message);


        // $message= 'Dear '.Auth::user()->first_name.' this is to inform you that we have success recieved your application for an appartment, at Talents Apartment. We will review your application and get back to you soon via email, Thank you';
        send_mail(Auth::user()->first_name, Auth::user()->email, 'Talents Apartment Application', $message);
        DB::table('user_notifications')->insert([
            'user_id' => Auth::user()->id,
            'title' => 'Application Recieved',
            'message' => 'Application Recieved',
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);
        // Mail::raw($message, function ($message){
        //     $message->to(Auth::user()->email);
        // });

        //send mail to admin
        $message = 'Dear Admin ' . Auth::user()->first_name . ' requested for an apartmnet kindly Click <a href="' . url('/booking_view') . '/' . Auth::user()->current_rent . '"> Here</a> to view booking';
        $settings = DB::table('settings')->first();
        send_mail('Admin', $settings->reg_email_recipient, 'Talents Apartment Application', $message);

        // Mail::raw($message, function ($message){
        //     $settings=DB::table('settings')->first();
        //     $message->to($settings->reg_email_recipient);
        // });


        return redirect('await_verification');
    }

    public function rentals()
    {
        return view('pages.rentals');
    }

    public function add_review(Request $request)
    {
        DB::table('users')->where('id', Auth::user()->id)->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        return redirect()->back()->with('success', 'Your review has been updated');
    }

    public function invoice($application_no)
    {

        $invoice = DB::table('invoices')->where('application_no', $application_no)->first();
        // dd($invoice);
        if ($invoice) {
            return view('pages.invoice')->with('invoice', $invoice);
        } else {
            return redirect('/profile')->with('error', 'Invalid Transaction ID');
        }
    }

    public function complain(Request $request)
    {

        // dd($request->all());

        $file = NULL;
        if ($files = $request->file('file')) {

            $filesName = 'user-' . Auth::id() . '-complain-file-' . $request->file->hashName();
            $request->file->storeAs('users-files', $filesName, 'public_uploads');
            $file = url('/users-files/' . $filesName);
        }

        $complianID = DB::table('complaints')->insertGetId([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category'),
            'description' => $request->input('description'),
            'complain' => $request->input('complain'),
            'complained_before' => $request->input('complained_before') == 'yes' ? true : false,
            'last_date' => $request->input('last_date') ? Carbon::parse($request->input('last_date'))->format('Y-m-d H:i:s') : Null,
            'status' => 'pending',
            'file' => $file ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'year' => DB::table('settings')->value('current_year'),
        ]);

        send_mail('Admin', DB::table('settings')->value('complain_email_recipient'), 'UPKEEP', DB::table('settings')->value('complain_email_template'));
        return redirect()->back()->with('success', 'Complain Submitted');
    }

    public function upkeep(Request $request)
    {


        return view('pages.upkeep');
    }

    public function upkeep_messages(Request $request, $id)
    {
        $complain = DB::table('complaints')->where('id', $id)->first();
        if ($complain) {
            return view('pages.upkeep-messages')->with(compact('complain'));
        } else {
            abort(404, 'Complain Not found');
        }
    }

    public function satisfactory_message(Request $request, $id)
    {
        $complain = DB::table('complaints')->where('id', $id)->first();
        if ($complain) {
            DB::table('complaints')->where('id', $id)->update([
                'satisfactory' => 'not satisfied',
            ]);
            DB::table('messages')->insert([
                'user_id' => $request->input('user_id'),
                'tasks_id' => $request->input('tasks_id'),
                'message' => $request->input('not_satisfied_message'),
                'status' => 'reply',
                'year' => DB::table('settings')->value('current_year'),
                'created_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('messages')->insert([
                'user_id' => $request->input('user_id'),
                'tasks_id' => $request->input('tasks_id'),
                'message' => 'You indicated that you were not satisfied or your complian has not been resolved. We are really sorry and we promise to do our best in other to resolve your complain. we will get back to you shortly',
                'status' => 'sent',
                'year' => DB::table('settings')->value('current_year'),
                'created_at' => \Carbon\Carbon::now()->addSeconds(15),
            ]);
            return redirect()->back()->with('success', 'Complian has been labeled as incomplete');
        } else {
            abort(404, 'Complain Not found');
        }
    }

    public function satisfactory_completed(Request $request, $id)
    {
        $complain = DB::table('complaints')->where('id', $id)->first();
        if ($complain) {
            DB::table('complaints')->where('id', $id)->update([
                'status' => 'completed'
            ]);
            return redirect()->back()->with('success', 'Complian has been labeled as completed');
        } else {
            abort(404, 'Complain Not found');
        }
    }

    public function message(Request $request)
    {
        DB::table('messages')->insert([
            'user_id' => $request->input('user_id'),
            'tasks_id' => $request->input('tasks_id'),
            'message' => $request->input('message'),
            'status' => 'reply',
            'year' => DB::table('settings')->value('current_year'),
            'created_at' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function services(Request $request)
    {
        return view('pages.services')->with('services', DB::table('products')->get());
    }
    public function add_consent(Request $request, User $user)
    {
        // dd($user);
        if ($request->action == 'enable') {

            $user->consent_document()->create([
                'document_id' => $request->document_id,
            ]);
            return redirect()->back()->with('success', 'You Have accepted this document');
        }

        if ($request->action == 'disable') {

            $user->consent_document()->where('document_id', $request->document_id)->delete();
            return redirect()->back()->with('warning', 'You just rejected this document');
        }

        // dd($request->all());
        return redirect()->back()->with('error', 'Nothing was done');
    }

    public function create_product_invoice($product_uid, Request $request)
    {
        $service = DB::table('products')->where('uid', $product_uid)->first();
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $application_no = strtoupper(substr($random, 0, 8));
        // json_decode()

        $payment_data = json_encode([
            'service_uid' => $service->uid,
        ]);

        if ($request->price === $service->price || in_array($request->price, explode(',', $service->price))) {

            // dd([$request->all(), $service]);

            $invoice = DB::table('invoices')->insert([
                'full_name' => Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name,
                'application_no' => $application_no,
                'amount' =>  $request->price,
                'email' => Auth::user()->email,
                'year' =>  DB::table('settings')->value('current_year'),
                'phone_number' => Auth::user()->phone_number,
                'type' => $service->name . 'Purchase ',
                'payment_data' => $payment_data
            ]);

            DB::table('purchased_services')->insert([
                'service_uid' => $service->uid,
                'application_no' => $application_no,
                'user_id' => Auth::user()->id,
                'status' => 'waiting'
            ]);

            return redirect('/services/purchase/__product/' . $service->uid . '/invoice/' . $application_no);
        } else {
            return redirect()->back()->with('error', 'Price was changed');
        }
    }

    public function purchase_product($uid, $application_no)
    {
        return view('pages.purchase-service')->with([
            'service' => DB::table('products')->where('uid', $uid)->first(),
            'invoice' => DB::table('invoices')->where('application_no', $application_no)->first()
        ]);
    }

    public function add_user_service($uid, $application_no, Request $request)
    {
        $invoice = DB::table('invoices')->where('application_no', $application_no)->first();
        $service = DB::table('products')->where('uid', $uid)->first();

        if ($invoice->payment_status == 'paid') {
            DB::table('purchased_services')->where('application_no', $invoice->application_no)->update([
                // 'service_uid' => $service->uid,
                // 'application_no' => $invoice->application_no,
                // 'user_id' => $invoice->user_id,
                'status' => 'purchased'
            ]);
        }

        $link = url('/profile');
    }


    public function send_guarantor_form($user_id)
    {
        $user = DB::table('users')->where('id', $user_id)->first();
        // sendPdf('isaac','isaacamehgreg@gmail.com', 'Registeration Success', 'your reg is success full','./guarantor.pdf');
        // sendPdf($user->g_first_name,$user->g_email, 'Talents Apartment Guarantor Form', $user->first_name.' '.$user->last_name.'wants you to stand as a guarantor','./guarantor.pdf');
        sendGurantorForm($user->id);
        echo 'pdf has been sent to your guarantor';
        DB::table('user_notifications')->insert([
            'user_id' => Auth::user()->first_name,
            'title' => 'pdf has been sent to your guarantor',
            'message' => 'pdf has been sent to your guarantor',
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->currentPassword, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->currentPassword, $request->newPassword) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('id', Auth::id())->first();
        //Change Password
        $user->update([
            'password' => bcrypt($request->get('newPassword')),
        ]);
        // $user = Auth::user();
        // $user->password = bcrypt($request->get('newPassword'));
        // $user->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }

    function verifyEmail(Request $request)
    {

        $code = $request->input('code');
        if (empty($code) || $code != Auth::user()->verification_code) {
            return view('auth.emailsent')->with('error', 'you entered a wrong code, copy the right code from your mail and try again');
        }
        DB::table('users')->where('id', Auth::user()->id)->update([
            'email_verified_at' => Carbon::now(),
        ]);
        return redirect('profile');
        // return view("auth.personal_info");

    }
}
