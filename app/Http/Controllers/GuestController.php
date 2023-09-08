<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function App\View\Components\send_mail;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $guests = Guest::whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
            $ongoing = Guest::where('status', 'ongoing')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
            $awaiting = Guest::where('status', 'awaiting')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
            $closed = Guest::where('status', 'closed')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        } else {

            $guests = Guest::orderBy('created_at', 'desc')->get();
            $ongoing = Guest::where('status', 'ongoing')->orderBy('created_at', 'desc')->get();
            $awaiting = Guest::where('status', 'awaiting')->orderBy('created_at', 'desc')->get();
            $closed = Guest::where('status', 'closed')->orderBy('created_at', 'desc')->get();
        }

        // $guests =  $guests->appends($request->all());

        return view('pages.guest.index')->with([
            'guests' => $guests,
            'all' => $guests,
            'awaiting' => $awaiting,
            'ongoing' => $ongoing,
            'closed' => $closed,
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }

    public function index_awaiting(Request $request)
    {
       
        $awaiting = Guest::where('status', 'awaiting')->get();

        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $awaiting = Guest::where('status', 'awaiting')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        } 

        return view('pages.guest.index')->with([
            'guests' => $awaiting,
            'all' => $guests = Guest::all(),
            'awaiting' => Guest::where('status', 'awaiting')->get(),
            'ongoing' => Guest::where('status', 'ongoing')->get(),
            'closed' => Guest::where('status', 'closed')->get(),
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }
    
    public function index_ongoing(Request $request)
    {
        
        $ongoing = Guest::where('status', 'ongoing')->get();
        
        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $ongoing = Guest::where('status', 'ongoing')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        } 

        return view('pages.guest.index')->with([
            'guests' => $ongoing,
            'all' => $guests = Guest::all(),
            'awaiting' => Guest::where('status', 'awaiting')->get(),
            'ongoing' => Guest::where('status', 'ongoing')->get(),
            'closed' => Guest::where('status', 'closed')->get(),
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }

    public function index_closed(Request $request)
    {
        $guests = Guest::all();
        $ongoing = Guest::where('status', 'ongoing')->get();
        $awaiting = Guest::where('status', 'awaiting')->get();
        $closed = Guest::where('status', 'closed')->get();

        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $closed = Guest::where('status', 'closed')->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        }

        return view('pages.guest.index')->with([
            'guests' => $closed,
            'all' => $guests,
            'awaiting' => $awaiting,
            'ongoing' => $ongoing,
            'closed' => Guest::where('status', 'closed')->get(),
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guest.create');
    }

    public function code_page(Request $request)
    {
        $matched = Guest::where('code', $request->_)->first();
        if($request->_){
            return view('pages.guest.code-page')->with([
                'matched' => $matched,
                'hasResult' => TRUE,
            ]);
        }else{
            return view('pages.guest.code-page');
        }
            
        
        
    }

    public function settings()
    {
        return view('pages.guest.settings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $user = User::find(Auth::id());

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $code = strtoupper(substr($random, 0, 4));
        $guest = $user->guest()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'type' => $request->type,
            'date' => $request->date,
            'code' => $code,
            'year' => DB::table('settings')->value('current_year'),
        ]);

        $input = ['[guest_name]', '[resident_name]', '[date]', '[room_number]', '[building_name]', '[room_name]', '[code]'];
        $outfilled = [$request->first_name.' '.$request->last_name, $user->first_name.' '.$user->last_name, $request->date, $user->bedspace->room_number, $user->bedspace->building_name, $user->bedspace->room->name, $code];
        $message =  str_replace($input, $outfilled,  DB::table('settings')->value('guest_message_template'));

        send_mail($request->first_name.' '.$request->last_name, $request->email, 'Guest Notice', $message);

        return redirect('/my-guest')->with('success', 'You have successfully added '.$request->first_name.' '.$request->last_name.' as guest');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all(Request $request, User $user)
    {
        $guests = $user->guest()->get();

        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $guests = $user->guest()->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        } else if ($request->resident) {

            $guests = Guest::where('user_id', User::where('first_name', ''))->orderBy('visit_start', 'desc')->get();
        
        }

        return view('pages.guest.user-guest')->with([
            'guests' => $guests ?? [],
            'hasResult' => TRUE,
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }

    public function show(User $user, Guest $guest)
    {
        //
    }


    public function user_guest(Request $request)
    {
        $user = User::find(Auth::id());
        $guests = $user->guest()->get();

        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;

            $guests = $user->guest()->whereBetween(DB::raw('DATE(visit_start)'), array($start_date, $end_date))->orderBy('visit_start', 'desc')->get();
        } else if ($request->resident) {

            $guests = Guest::where('user_id', User::where('first_name', ''))->orderBy('visit_start', 'desc')->get();
        
        }

        return view('pages.guest.user-guest')->with([
            'guests' => $guests ?? [],
            'hasResult' => TRUE,
            'date' => [
                'start' => $start_date ?? '',
                'end' => $end_date ?? '',
            ],
        ]);
    }

    public function update_settings(Request $request)
    {
        DB::table('settings')->update([
            'global_max_guest_per_day'=>$request->global_max_guest_per_day,
            'guest_message_template'=>$request->guest_message_template,
        ]);

        return redirect()->back()->with('success', 'Settings Saved!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        if($request->type == 'sign-in'){

            $guest->update([
                'visit_start' => Carbon::now(),
                'status' => 'ongoing',
            ]);
            return redirect()->back()->with('success', 'Guest successfully Sign In!');

        }elseif($request->type == 'sign-out'){

            $guest->update([
                'visit_end' => Carbon::now(),
                'status' => 'closed',
            ]);
            return redirect()->back()->with('success', 'Guest successfully Sign Out!');
        }else{
            return redirect()->back()->with('warning', 'An Error Occured!');
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
