<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rent;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;
use function App\View\Components\send_mail;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use function App\View\Components\sendHealthForm;
use function App\View\Components\sendGurantorForm;
use function App\View\Components\createNotification;
use function App\View\Components\sendAttestationForm;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function book(Request $request)
    {
        $rooms = Null;
        // $user = DB::table('users')->where('id',Auth::user()->id)->first();
        // $current_rent = DB::table('rents')->where('id',  $user->current_rent)->first();
        // $location = DB::table('rooms')->where('id', $current_rent->room_id)->value('location');
        $location = $request->location;
        if (isset($request->location) && $request->location != Null) {

            $get_rooms = DB::table('rooms')->where('location', $location)->get();
        } else {
            $get_rooms = DB::table('rooms')->get();
        }

        // dd($get_rooms);
        // $rooms = $bedSpace = BedSpace::where('room_id', $request->room_id)->where('room_number', $request->room_number)->where('user_id', $request->user_id)->orWhere('room_id', $request->room_id)->where('room_number', $request->room_number)->whereNull('user_id')->where('allocated', false)->get();

        foreach ($get_rooms as $room) {
            $bedSpace = BedSpace::where('room_id', $room->id)->whereNull('user_id')->where('allocated', false)->get()->count();

            if ($bedSpace > 0) {
                $rooms[] = $room;
            }
        }
        return view('pages.book')->with(['rooms' => $rooms]);
    }

    public function book_room(Request $request)
    {
        // dd($request->all());
        // request()->validate([
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        // $photo="no image";

        // if ($files = $request->file('photo')) {
        //     $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();
        //     $photo = $response;
        // }

        $insertLastId = DB::table('rents')->insertGetId([
            'user_id' => Auth::user()->id,
            'room_id' => $request->input('room_id'),
            'price' => $request->input('price'),
            'status' => 'pending',
            //   'payment_reference'=>$request->input('reference'),
            'note' => $request->input('note'),
            //   'photo' => $photo,
            "year" => DB::table('settings')->value('current_year'),
            'created_at' => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table('users')->where('id', Auth::user()->id)->update([
            'updated_at' => Carbon::now(),
            'current_rent' => $insertLastId,
        ]);

        $message = 'Dear Admin ' . Auth::user()->first_name . ' has booked for a new room, Click <a href="' . url('/booking_view') . '/' . $insertLastId . '"> Here</a> to view booking';
        send_mail('Admin', DB::table('settings')->value('payment_email_recipient'), 'Application Update', $message);
        createNotification('New Booking', Auth::user()->first_name . ' ' . Auth::user()->last_name, 'Booked for a new room in ' . DB::table('rooms')->where('id', $request->input('room_id'))->value('name'));
        return redirect('profile');
    }



    public function bookings()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');
        if (!empty(request('sort')) && request()->input('sort') == 'new') {
            $rents = Rent::where('year', $viewingYear)->where('status', '!=', 'Archived')->where('type', 'new')->whereBetween('updated_at', [\Carbon\Carbon::now()->subWeek(), \Carbon\Carbon::now()])->where('status', '!=', 'Approved')->latest('id')->get()->sortByDesc('status_percentage');
            // $rents->appends(request()->all());
            // return view('pages.bookings')->with(['rents'=>$rents]);
        } elseif (!empty(request('sort')) && request()->input('sort') != 'new') {
            $rents = Rent::where('year', $viewingYear)->where('status', '!=', 'Archived')->where('type', 'new')->where('status', request()->input('sort'))->latest('id')->get()->sortByDesc('status_percentage');
            // $rents->appends(request()->all());
            // return view('pages.bookings')->with(['rents'=>$rents]);
        } else {
            $rents = Rent::where('year', $viewingYear)->where('status', '!=', 'Archived')->where('type', 'new')->where('status', '!=', 'Approved')->get()->sortByDesc('status_percentage');
            // return view('pages.bookings')->with(['rents'=>$rents]);
        }


        $perPage = 11;
        $currentPage = request()->get('page', 1);
        // $rent_data = new \Illuminate\Pagination\LengthAwarePaginator(
        //     $rents->forPage($currentPage, $perPage),
        //     $rents->count(),
        //     $perPage,
        //     $currentPage,
        //     ['path' => 'room-types']
        // );

        return view('pages.bookings')->with(['rents' => $rents]);
    }


    public function archived_rent()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');

        $rents = DB::table('rents')->where('status', 'Archived')->where('year', $viewingYear)->orderBy('id', "DESC")->get();


        return view('pages.bookings-renewals')->with(['rents' => $rents]);
    }

    public function renewal()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');

        $rents = DB::table('rents')->where('type', 'renewal')->where('year', $viewingYear)->orderBy('id', "DESC")->get();

        return view('pages.bookings-renewals')->with(['rents' => $rents]);
    }

    public function progress_bar()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');

        $rents = DB::table('rents')->where('status', '!=', 'Approved')->where('year', $viewingYear)->orderBy('id', "DESC")->get();
        $all = [];
        foreach ($rents as $rent) :

            if ($rent->school_check_status != 'Approved' && $rent->payment_reference == null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null) :
                $rent->progress = 10;
            elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference == null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null) :
                $rent->progress = 20;
            elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo == null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null) :
                $rent->progress = 35;
            elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo == null && $rent->attestation_letter_photo == null) :
                $rent->progress = 75;
            elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo != null && $rent->attestation_letter_photo == null) :
                $rent->progress = 85;
            elseif ($rent->school_check_status == 'Approved' && $rent->payment_reference != null && $rent->guarantor_letter_photo != null && $rent->health_check_photo != null && $rent->attestation_letter_photo != null) :
                $rent->progress = 100;
            endif;
            $all[] = $rent;
        endforeach;

        return view('pages.progress_bar')->with(['rents' => $all]);


        // dd($all);


    }


    public function view_bookings($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        $user_id = $rent->user_id;
        return view('pages.view_bookings')->with(['id' => $id, 'rent' => $rent, 'user_id' => $user_id]);
    }

    public function approve_renewal(Request $request, $id)
    {
        // dd($request->all());
        $rent = DB::table('rents')->where('id', $id)->first();

        if ($request->room_change_status == 'Approved') {
            $new_rent = DB::table('rents')->where('type', 'renewal')->where('previous_rent', $rent->id)->first();
            $new_room = DB::table('rooms')->where('id', $new_rent->requested_room)->first();
            $room_id = $new_room->id;
            $room_price = $new_room->price;
        } else {
            $room_id = $rent->room_id;
            $room_price = $rent->original_price;
        }

        DB::table('rents')
            ->where('type', 'renewal')
            ->where('previous_rent', $rent->id)
            ->update([
                'room_change_status' => $request->room_change_status,
                'room_id' => $room_id,
                'price' => $room_price,
                'original_price' => $room_price,
                'status' => 'Approved',
            ]);
        return redirect()->back()->with('success', 'Renewal request has been approved');
    }

    public function decline_renewal($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        DB::table('rents')
            ->where('type', 'renewal')
            ->where('previous_rent', $rent->id)
            ->update([
                'status' => 'Declined'
            ]);
        return redirect()->back()->with('success', 'Renewal request has been declined');
    }

    public function view_bookings_renewal($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        $user_id = $rent->user_id;
        return view('pages.view_bookings_renewal')->with(['id' => $id, 'rent' => $rent, 'user_id' => $user_id]);
    }

    public function booking($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        $user_id = $rent->user_id;
        if (!empty(DB::table('rents')->where('id', $rent->id)->value('expiring_date')) && DB::table('rents')->where('id', $rent->id)->value('expiring_date') < \Carbon\Carbon::now()) {
            return redirect('/rentals')->with('error', 'Your rent has expired, Check Rents to book a new Room');
        } else {

            return view('pages.view_bookings')->with(['id' => $id, 'rent' => $rent, 'user_id' => $user_id]);
        }
    }

    public function booking_renew($id)
    {
        $rent = DB::table('rents')->where('id', $id)->first();
        $user_id = $rent->user_id;

        return view('pages.booking-renewal');
    }
    public function renew_booking(Request $request, $id)
    {
        dd($request->all());
    }
    public function archive($rent_id)
    {
        $get_rent_details = DB::table('rents')->where('id', $rent_id)->first();
        //Remove Tenant from the room
        $bedSpace = BedSpace::where('id', $get_rent_details->bed_space)->update([
            'allocated' => false,
            'user_id' => Null,
        ]);

        //Set Rent Status to Archive
        $rent = DB::table('rents')->where('id', $rent_id)->update([
            'status' => 'Archived'
        ]);

        createNotification('Rent Archived', Auth::user()->first_name, 'Archived ' . DB::table('users')->where('id', $get_rent_details->user_id)->value('first_name') . ' ' . DB::table('users')->where('id', $get_rent_details->user_id)->value('last_name') . ' Rent');


        $user = DB::table('users')->where('id', $get_rent_details->user_id)->first();
        // $password = $code;
        $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[profile_link'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), url('/profile')];
        $message =  str_replace($input, $outfilled, DB::table('settings')->value('rent_archived_message'));


        // $message= 'congratulations you rent has been approved kindly proceed to Our website with the password : '.$code;

        send_mail(DB::table('users')->where('id', $get_rent_details->user_id)->value('first_name'), DB::table('users')->where('id', $get_rent_details->user_id)->value('email'), 'Talents Apartment Rent Archived', $message);

        DB::table('user_notifications')->insert([
            'user_id' => $get_rent_details->user_id,
            'title' => 'You rent has been archived',
            'message' => 'You rent has been archived',
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);

        return redirect()->back();
    }

    public function approve_rent(Request $request)
    {



        $bed_space = $request->bed_space;
        $move_in = Carbon::parse($request->move_in)->format('Y-m-d H:i:s');
        $expiring_date = $request->move_out ? Carbon::parse($request->move_out)->format('Y-m-d H:i:s') : Carbon::parse($move_in)->addYear()->format('Y-m-d H:i:s');
        $id = $request->input('id');

        // dd($expiring_date);
        //  $approve = DB::table('rents')-> where('id', $id)->update([
        //      'status' => 'approved',
        //  ]);
        $get_rent_details = DB::table('rents')->where('id', $id)->first();
        $bedSpace = BedSpace::where('id', $get_rent_details->bed_space)->update([
            'allocated' => false,
            'user_id' => Null,
        ]);

        //   dd($request);
        $rent = DB::table('rents')->where('id', $id)->update([
            'bed_space' => $bed_space,
            'move_in' => $move_in,
            'expiring_date' => $expiring_date,
            'status' => 'Approved',
        ]);


        // if($rent){
        $rent_details = DB::table('rents')->where('id', $id)->first();
        $bedSpace = BedSpace::where('id', $bed_space)->update([
            'allocated' => true,
            'user_id' => $rent_details->user_id,
        ]);

        $user = DB::table('users')->where('id', $rent_details->user_id)->first();

        if (!isset($user->ta_uid)) {
            $ta_uid = 'TA' . substr(DB::table('settings')->value('current_year'), -2) . date('m') . $user->id;
            DB::table('users')->where('id', $user->id)->update([
                'ta_uid' => $ta_uid,
            ]);
        }
        // }


        // dd($rent);


        createNotification('Admin Approval', Auth::user()->first_name, 'Approved ' . DB::table('users')->where('id', $request->user_id)->value('first_name') . ' ' . DB::table('users')->where('id', $request->user_id)->value('last_name') . ' Rent');
        //update user password
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $code = substr($random, 0, 8);

        // DB::table('users')->where('id', $request->user_id)->update([
        //     'password' => Hash::make($code),
        // ]);

        $user = DB::table('users')->where('id', $request->user_id)->first();
        // $password = $code;
        $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[profile_link'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), url('/profile')];
        $message =  str_replace($input, $outfilled, DB::table('settings')->value('rent_approved_message'));


        // $message= 'congratulations you rent has been approved kindly proceed to Our website with the password : '.$code;

        send_mail(DB::table('users')->where('id', $request->user_id)->value('first_name'), DB::table('users')->where('id', $request->user_id)->value('email'), 'Talents Apartment Approved Rent', $message);

        DB::table('user_notifications')->insert([
            'user_id' => $request->user_id,
            'title' => 'You rent has been approved',
            'message' => 'You rent has been approved',
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);

        return redirect()->back();
    }

    public function decline_rent($id)
    {
        $dell = DB::table('rent')->where('id', $id)->delete();
        return redirect('/room');
    }

    public function approve($id)
    {
        $rent = DB::table('rents')->where('id', $id)->update([
            'status' => 'Approved'
        ]);
        return redirect()->back();
    }


    public function reject($id)
    {
        $rent = DB::table('rents')->where('id', $id)->update([
            'status' => 'Declined'
        ]);

        return redirect()->back();
    }

    public function school_info_status(Request $request)
    {
        $date = Carbon::create($request->input('move_in'));

        $bed_space = $request->input('inside_room');
        $move_in = $date->toDateTimeString();
        $expiring_date = $date->addYear();
        $id = $request->input('id');
        $rent = DB::table('rents')->where('id', $id)->update([
            'bed_space' => $bed_space,
            'move_in' => $move_in,
            'expiring_date' => $expiring_date,
        ]);


        return redirect()->back();
    }

    public function booking_step(Request $request)
    {
        $step = $request->input('step');
        $user_id = $request->input('user_id');
        $rent_id = $request->input('rent_id');
        $payment_reference = $request->input('payment_reference');
        $type = '';


        if ($step == 'picture') {
            request()->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'file' => 'required|file|mimes:pdf',
            ]);
        } else {
            request()->validate([
                // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file' => 'required|file|mimes:pdf',
            ]);
        }



        $file = NULL;


        if ($files = $request->file('file')) {

            $filesName = 'user-' . Auth::id() . '-' . $step . '-file-' . $request->file->hashName();
            $request->file->storeAs('users-files', $filesName, 'public_uploads');
            $file = url('/users-files/' . $filesName);
        }

        if ($step == 'guarantor') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'guarantor_letter_photo' => $file
            ]);
            //send mail to admin
            $type = 'guarantors form';
        } elseif ($step == 'payment') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'photo' => $file,
                'payment_reference' => $payment_reference
            ]);
            $type = 'proof of payment';
        } elseif ($step == 'health') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'health_check_photo' => $file
            ]);
            $type = 'health status report';
        } elseif ($step == 'attestation') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'attestation_letter_photo' => $file
            ]);
            $type = 'letter of attestation';
        } elseif ($step == 'picture') {
            $update = DB::table('users')->where('id', $user_id)->update([
                'photo' => $file
            ]);
            $type = 'profile picture';
        }
        $message = 'Dear Admin ' . Auth::user()->first_name . ' has submitted ' . $type;
        send_mail('Admin', DB::table('settings')->value('payment_email_recipient'), 'Application Update', $message);

        return redirect()->back();
    }

    public function booking_status(Request $request)
    {
        $step = $request->input('step');
        $user_id = $request->input('user_id');
        $rent_id = $request->input('rent_id');
        $status = $request->input('status');
        $user = DB::table('users')->where('id', $user_id)->first();

        DB::table('settings')->update(['current_user' => $user_id]);
        $message = '';
        $business = DB::table('settings')->first();

        //dd($status);


        if ($step == 'guarantor') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'guarantor_letter_status' => $status
            ]);
            $type = 'guarantors form';
            //send mail to admin
            // $message= 'Dear '.$user->first_name.' your guarantors form is '.$status.' '.$business->file_email_template;

            $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[pass]', '[profile_link]'];
            $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), $password ?? '', url('/profile')];
            $message =  str_replace($input, $outfilled, $business->approved_document_message);
        } elseif ($step == 'payment') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'proof_status' => $status
            ]);

            $type = 'proof of payment';

            // $message= 'Dear '.$user->first_name.' your proof of payment is '.$status.' '.$business->payment_email_template;
            $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[pass]', '[profile_link]'];
            $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), $password ?? '', url('/profile')];
            $message =  str_replace($input, $outfilled, $business->approved_document_message);
            sendAttestationForm($user->id);
            sendHealthForm($user->id);
        } elseif ($step == 'health') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'health_check_status' => $status
            ]);
            $type = 'health form';
            // $message= 'Dear '.$user->first_name.' your health check form is '.$status.' '.$business->file_email_template;
            $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[pass]', '[profile_link]'];
            $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), $password ?? '', url('/profile')];
            $message =  str_replace($input, $outfilled, $business->approved_document_message);
        } elseif ($step == 'attestation') {
            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'attestation_letter_status' => $status
            ]);
            $type = 'Letter of Attestation';
            // $message= 'Dear '.$user->first_name.' your letter of Attestation is '.$status.' '.$business->file_email_template;
            $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[pass]', '[profile_link]'];
            $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), $password ?? '', url('/profile')];
            $message =  str_replace($input, $outfilled, $business->approved_document_message);
        } elseif ($step == 'school') {

            $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
                'school_check_status' => $status,
            ]);



            if ($status == 'Approved') {
                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
                $code = substr($random, 0, 8);
                //update user password
                // $update = DB::table('users')->where('email', $user->email)->update([
                //     'password' => Hash::make($code),
                // ]);
                // $password = $code;
                $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[profile_link]'];
                $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), url('/profile')];
                $message =  str_replace($input, $outfilled, $business->school_details_approved_message);

                // $message= " Hello ".$user->first_name.',</br> we have check your school details and have
                // approve you to proceed with registration, use this password to login to you your account
                // </br><h3><u>'.$code. '</u></h3>
                // Click  <a href="'.url('/profile').'"> Here </a> to Access Your Portal or Reload existing page
                // </br> Proceed to making payment for with the following details '."\n".'</br> Bank Name: '.$business->bank_name ."\n".'</br> Bank Name: '.$business->bank_account. "\n".'</br> Business Name: '.$business->business_name. "</br> and uplaod proof of payment";
                //Send Guarantor form immediately
                // sendPdf($user->g_first_name, $user->g_email, 'Talents Apartment Guarantor Form', $user->first_name.' '.$user->last_name.'wants you to stand as a guarantor', asset('guarantor.pdf'));
                sendGurantorForm($user->id);

                //Create TAID if not assigned
                // if(!isset($user->ta_uid)){
                //     $ta_uid = 'TA'.substr(DB::table('settings')->value('current_year'),-2).date('m').$user->id;
                //     DB::table('users')->where('id', $user->id)->update([
                //         'ta_uid' => $ta_uid,
                //     ]);
                // }

            } else {
                $message = " Hello " . $user->first_name . ',</br> the school detail you provided is ' . $status;
            }

            // send_mail('Admin', DB::table('settings')->value('payment_email_recipient'), 'Application Update', $message);
            // if ($status = 'Approved') {
            //     send_mail($user->first_name, $user->email, 'Application Status', $message);
            // }

        }

        if ($status = 'Approved') {
            send_mail($user->first_name, $user->email, 'Application Status', $message);
            // sendGurantorForm($user->id);
            DB::table('user_notifications')->insert([
                'user_id' => $request->user_id,
                'title' => 'New Email #Application Status Please Check your email',
                'message' => 'New Email #Application Status Please Check your email',
                'status' => 'unread',
                'year' => DB::table('settings')->value('current_year')
            ]);
        }


        return redirect()->back();
    }

    public function update_booking_status(Request $request)
    {
        $step = $request->input('step');
        $user_id = $request->input('user_id');
        $rent_id = $request->input('rent_id');
        $status = $request->input('status');
        $user = DB::table('users')->where('id', $user_id)->first();

        DB::table('settings')->update(['current_user' => $user_id]);
        $message = '';
        $business = DB::table('settings')->first();

        // dd($request->all());
        $type = '';

        if ($request->proof_status == 'Approved') {
            // dd('ap');
            $type .=  'Proof of payment';
            sendAttestationForm($user->id);
            sendHealthForm($user->id);
        }

        if ($request->guarantor_letter_status == 'Approved') {
            if ($type == '') {
                $type .=  'Guarantors form';
            } else {
                $type .=  ', Guarantors form';
            }
        }

        if ($request->health_check_status == 'Approved') {
            if ($type == '') {
                $type .=  'Health form';
            } else {
                $type .=  ', Health form';
            }
        }
        if ($request->attestation_letter_status == 'Approved') {
            if ($type == '') {
                $type .=  'Letter of Attestation';
            } else {
                $type .=  ' and Letter of Attestation';
            }
        }

        $update = DB::table('rents')->where('id', $rent_id)->where('user_id', $user_id)->update([
            'proof_status' => $request->proof_status,
            'guarantor_letter_status' => $request->guarantor_letter_status,
            'attestation_letter_status' => $request->attestation_letter_status,
            'health_check_status' => $request->health_check_status
        ]);

        $input = ['[first_name]', '[middle_name]', '[last_name]', '[type]', '[pass]', '[profile_link]', '[message]'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, ucwords($type ?? ''), $password ?? '', url('/profile'), $request->message];
        $message =  str_replace($input, $outfilled, $business->approved_document_message);

        send_mail($user->first_name, $user->email, 'Application Status', $message);

        DB::table('user_notifications')->insert([
            'user_id' => $request->user_id,
            'title' => $type != '' ? 'Your ' . $type . ' has been approved' : 'New Email #Application Status Please Check your email',
            'message' => $type != '' ? 'Your ' . $type . ' has been approved' : 'New Email #Application Status Please Check your email',
            'status' => 'unread',
            'year' => DB::table('settings')->value('current_year')
        ]);

        return redirect()->back()->with('success', 'Documents status updated successfully');
    }
}
