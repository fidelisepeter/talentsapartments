<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Promo;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.promo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_type()
    {
        return view('pages.promo.new-promo-type');
    }

    public function regular()
    {
        return view('pages.promo.regular');
    }

    public function special()
    {
        return view('pages.promo.special');
    }

    public function referral()
    {
        return view('pages.promo.referral');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        if ($request->promo_type == 'regular') {
            if($request->room_data == null || count($request->room_data) == 0){
                return redirect()->back()->with('error', 'Please specify atleast a room to promo');
            }
            $promo_data = json_encode($request->room_data);
        } else {
            if($request->room_id == null){
                return redirect()->back()->with('error', 'Please specify atleast a room to promo');
            }
            $promo_data = json_encode([
                'room_id' => $request->room_id,
                'percentage_off' => $request->percentage_off,
            ]);
        }

        if ($files = $request->file('thumbnail')) {
            // Define upload path
            $destinationPath = public_path("/thumbnails/"); // upload path
            // Upload Orginal Image
            $thumbnail = url('/thumbnails/' . date('YmdHis-') . $request->promo_code . "." . $files->getClientOriginalExtension());
            $files->move($destinationPath, $thumbnail);
        }

        $promo = Promo::create([
            'promo_code' => $request->promo_code,
            'thumbnail' => $thumbnail ?? '',
            'promo_type' => $request->promo_type,
            'description' => $request->description,
            'promo_data' => $promo_data,
            'start_date' => new Carbon($request->start_date),
            'end_date' => new Carbon($request->end_date),
            'active' => $request->active == 'on' ? true : false,
            'show' => $request->show == 'on' ? true : false,
        ]);

        return redirect('/all-promo')->with('success', 'Promo Code has been been created');
        //   dd($promo);s
    }

    public function change_active_status(Request $request)
    {


        $promo = Promo::where('promo_code', $request->promo_code)->update([
            'active' => $request->active == 'on' ? true : false,
        ]);

        return redirect('/all-promo')->with('success', 'Promo Code has been been update');
        //   dd($promo);
    }

    public function update_referral_settings(Request $request)
    {


        DB::table('settings')->update([
            'referral' => $request->referral_status == 'on' ? true : false,
            'referral_amount' => $request->referral_amount,
            'referral_payable_amount' => $request->referral_payable_amount,
            'referral_expiring_date' => $request->referral_expiring_date,
        ]);

        return redirect()->back()->with('success', 'Promo Code has been been update');
        //   dd($promo);
    }

    public function generate_referral_code()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $referral_code = substr($random, 0, 8);
        User::where('id', Auth::user()->id)->update([
            'referral_code' => $referral_code,
        ]);

        return redirect()->back()->with('success', 'Referral Code has been been created');
        //   dd($promo);
    }

    public function check_promo_code(Request $request)
    {

        $promo_code = $request->promo_code;
        $room_id = $request->room_id;
        $is_valid = false;
        $percentage_off = 0;

        $room = DB::table('rooms')->where('id', $room_id)->first();
        $room_location = DB::table('locations')->where('id', $room->location)->value('name');
        $room_amenities = $room->amenity1 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity1)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity2 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity2)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity3 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity3)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity4 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity4)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity5 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity5)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity6 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity6)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity7 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity7)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity8 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity8)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity9 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity9)->value('name') . '</span></div></div>' : '';
        $room_amenities .= $room->amenity10 ? '<div class="d-flex justify-content-lg-start justify-content-center p-2"><div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center"><i class="fas fa-check opacity-10"></i></div><div><span class="ps-3 text-xs">' . DB::table('amenities')->where('id', $room->amenity10)->value('name') . '</span></div></div>' : '';


        $promo = Promo::where('promo_code', $promo_code)->first();


        if(!empty($promo)) {

            $room_data = json_decode($promo->promo_data, true);
            if ($promo->promo_type == 'special') {
                if ($room_data['room_id'] == $room_id) {
                    $is_valid = true;
                    $percentage_off = $room_data['percentage_off'];
                }
            } elseif ($promo->promo_type == 'regular') {
                foreach ($room_data as $value) {
                    if ($value['room_id'] == $room_id) {
                        $is_valid = true;
                        $percentage_off = $value['percentage_off'];
                    }
                }
            }

            // if ($promo->end_date < \Carbon\Carbon::now()) {
            //     $error_message = 'Promo Code has expired';
            // }



            if ($is_valid && $promo->end_date > \Carbon\Carbon::now()) {

                $cal_percentage_off = ($room->price / 100) * $percentage_off;
                $discount_price = ($room->price - $cal_percentage_off);

                $result = [
                    'status' => 'success',
                    'message' => $promo->description .' ('.$room->name.' at %'.$percentage_off.' off)',
                    'room' => $room,
                    'room_location' => $room_location ?? '',
                    'room_amenities' => $room_amenities ?? '',
                    'discount_price' => $discount_price,
                    'percentage_off' => $percentage_off,
                ];
            } else {
                $result = [
                    'status' => 'error',
                    'message' => $error_message ?? 'Promo has expired or the code is not applicable to selected room.',
                    'room' => $room,
                    'room_location' => $room_location ?? '',
                    'room_amenities' => $room_amenities ?? '',
                ];
            }
        } else {

            $result = [
                'status' => 'error',
                'message' => 'Invalid promo code',
                'room' => $room,
                'room_location' => $room_location ?? '',
                'room_amenities' => $room_amenities ?? '',
            ];
        }

        $result['room_id'] = $room_id;
        $result['promo_code'] = $promo_code;

        return json_encode($result);
        dd($result);
    }

    public function make_referral_payment(Request $request)
    {

        $user = User::where('id', $request->resident_id)->first();
        $resident_referral_balance = DB::table('referrals_earnings')->where('referrer', $user->id)->sum('amount') - DB::table('referrals_payments')->where('referrer_id', $request->resident_id)->sum('amount');
        $referral_payable_amount = DB::table('settings')->value('referral_payable_amount');

        if ($request->payment_amount > $resident_referral_balance || $request->payment_amount < $referral_payable_amount) {
            return redirect()->back()->with('error', 'Insufficient Balance or resident balance has not reach the payable amount');
        }

        // if(empty($user->referral_code)){
        //     return redirect()->back()->with('error', 'Problem Processing Resident Referral Code');
        // }

        // dd($user);
        DB::table('referrals_payments')->insert([
            'referrer_id' => $user->id,
            'referral_code' => $user->referral_code ?? 'uytr',
            'amount' => $request->payment_amount,
            'paid_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Payment is successful!, Balance has been updated');
        //   dd($promo);
    }


    public function referrer(Request $request, $user_id)
    {
        $d = Referral::where('referrer', $user_id)->join('referrals_payments', 'referrals_earnings.referrer', '=', 'referrals_payments.referrer_id')->get();
        $referrals_earnings = DB::table('referrals_earnings')->where('referrer', $user_id)->get();
        $referrals_payments = DB::table('referrals_payments')->where('referrer_id', $user_id)->get();
        $transactions = $referrals_payments->concat($referrals_earnings);


        $user = User::where('id', $user_id)->first();
        return view('pages.promo.referrer')->with([
            'user' => $user,
            'transactions' => $transactions->sortBy('created_at', SORT_REGULAR, false),
        ]);
    }

    public function referrer_dashboard(Request $request)
    {
        // $d = Referral::where('referrer', $user_id)->join('referrals_payments', 'referrals_earnings.referrer', '=', 'referrals_payments.referrer_id')->get();
        $user = User::where('id', Auth::user()->id)->first();
        $referrals_earnings = DB::table('referrals_earnings')->where('referrer', $user->id)->get();
        $referrals_payments = DB::table('referrals_payments')->where('referrer_id', $user->id)->get();
        $transactions = $referrals_payments->concat($referrals_earnings);



        return view('pages.promo.referrer-dashboard')->with([
            'user' => $user,
            'transactions' => $transactions->sortBy('created_at', SORT_REGULAR, false),
        ]);
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
    public function edit($promo_code)
    {
        $promo = Promo::where('promo_code', $promo_code)->first();
        return view('pages.promo.edit-promo')->with([
            'promo' => $promo,
        ]);
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
        if ($request->promo_type == 'regular') {
            if($request->room_data == null || count($request->room_data) == 0){
                return redirect()->back()->with('error', 'Please specify atleast a room to promo');
            }
            $promo_data = json_encode($request->room_data);
        } else {
            if($request->room_id == null){
                return redirect()->back()->with('error', 'Please specify atleast a room to promo');
            }
            $promo_data = json_encode([
                'room_id' => $request->room_id,
                'percentage_off' => $request->percentage_off,
            ]);
        }

        if ($files = $request->file('thumbnail')) {
            // Define upload path
            $destinationPath = public_path("/thumbnails/"); // upload path
            // Upload Orginal Image
            $thumbnail = url('/thumbnails/' . date('YmdHis-') . $request->promo_code . "." . $files->getClientOriginalExtension());
            $files->move($destinationPath, $thumbnail);
        }

        $promo = Promo::where('id', $request->promo_id)->first();

        Promo::where('id', $request->promo_id)->update([
            'promo_code' => $request->promo_code,
            'thumbnail' => $thumbnail ?? $promo->thumbnail,
            'promo_type' => $request->promo_type,
            'description' => $request->description,
            'promo_data' => $promo_data,
            'start_date' => new Carbon($request->start_date),
            'end_date' => new Carbon($request->end_date),
            'active' => $request->active == 'on' ? true : false,
            'show' => $request->show == 'on' ? true : false,
        ]);
        return redirect('/all-promo')->with('success', 'Promo Code has been been update');
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
}
