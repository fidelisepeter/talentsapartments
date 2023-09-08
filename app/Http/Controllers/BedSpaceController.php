<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BedSpaceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }

    function edit_bedspace($id)
    {
        $bedSpace = BedSpace::where('id', $id)->first();
        return view('pages.edit-bed-space')->with('bedspace', $bedSpace);
    }

    function update_bedspace(Request $request, $id)
    {
        $bedSpace = BedSpace::where('id', $id)->first();
        $bedSpace->update([
            'name' => $request->name,
            'room_id' => $request->type,
            'room_number' => $request->room_number,
            'building_name' =>  $request->building_name,
            'room_label' =>  $request->room_label,
            'year' => DB::table('settings')->value('current_year'),
        ]);
        return redirect('/bedspaces')->with('success', 'Bed space created successfully');
    }

    function remove_resident($id)
    {
        
       

        BedSpace::where('id', $id)->update([
            'allocated' => false,
            'user_id' => Null,
        ]);

        
        $rent = DB::table('rents')->where('bed_space', $id)->first();

        DB::table('rents')->where('id', $rent->id)->update([
            'bed_space' => Null,
        ]);

        return redirect('/booking_view/' . $rent->id)->with('success', 'Resident Removed successfully');
    }

    function index(Request $request)
    {

        $getFirst = [];
        // $getFirst = json_decode(json_encode([]));
        $getAll =  [];
        $count_allocated = 0;
        $count_freespace = 0;
        $freespace = 0;
        $allocated = 0;
        $viewingYear = DB::table('settings')->value('viewing_year');

        $bedSpace = BedSpace::orderBy('room_number', 'desc')->where('year', $viewingYear)->get()->unique('room_id');
        foreach ($bedSpace as $view) {
            $roomlist = BedSpace::where('room_id', $view->room->id)->where('year', $viewingYear)->get()->unique('room_number');
            foreach ($roomlist as $list) {
                foreach (BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->where('year', $viewingYear)->orderBy('room_number', 'desc')->get()->unique('room_number') as $roomView) {
                    // $roomView->display_name = $roomView->room->name.' - '.$roomView->room_number;

                    $roomView->display_name = $roomView->room_number . ' - ' . $roomView->room->name;
                    $roomView->display_name_r = $roomView->room_number . ' - ' . $roomView->room->name;

                    $getAll[] =  $roomView;
                    $getFirst =  $roomView;

                    $count_freespace = BedSpace::where('room_id', $roomView->room->id)->where('room_number', $roomView->room_number)->whereNull('user_id')->where('allocated', false)->where('year', $viewingYear)->get()->count();
                    $count_allocated = BedSpace::where('room_id', $roomView->room->id)->where('room_number', $roomView->room_number)->whereNotNull('user_id')->where('allocated', true)->where('year', $viewingYear)->get()->count();
                    // if($roomView->user_id == Null && $roomView->allocated == false){
                    //     $count_freespace++;
                    // }else{
                    //     $count_allocated++;
                    // }


                }
            }
        }

        if ($request->method('post') && $request->sortbyRoom) {

            $sortbyRoom = json_decode($request->sortbyRoom);



            $sortbyRoom->display_name = $sortbyRoom->room_number . ' - ' . $sortbyRoom->room->name;
            $bedSpaces = BedSpace::where('room_id', $sortbyRoom->room->id)->where('room_number', $sortbyRoom->room_number)->where('year', $viewingYear)->get();
            $freespace = BedSpace::where('room_id', $sortbyRoom->room->id)->where('room_number', $sortbyRoom->room_number)->whereNull('user_id')->where('allocated', false)->where('year', $viewingYear)->get()->count();
            $allocated = BedSpace::where('room_id', $sortbyRoom->room->id)->where('room_number', $sortbyRoom->room_number)->whereNotNull('user_id')->where('allocated', true)->where('year', $viewingYear)->get()->count();
            // dd($sortbyRoom);
        } else {
            $bedSpaces = BedSpace::where('room_id', $getFirst->room->id ?? 00000)->where('room_number', $getFirst->room_number ?? 00000)->where('year', $viewingYear)->get();
            // $bedSpaces = $getAll;
            $freespace = $count_freespace;
            $allocated = $count_allocated;
        }


       
        $room_types = Room::where('year', DB::table('settings')->value('viewing_year'))->get()->sortByDesc('available');
        
        return view('pages.bed-space')->with([
            'room_view' => $getAll,
            'freespace' => $freespace,
            'allocated' => $allocated,
            'bedspaces' => $bedSpaces,
            'current' => $sortbyRoom ?? '',
            'alt_view' => $getFirst ?? '',
            'room_types' => $room_types,
        ]);

        // dd($sortbyRoom);
    }

    function create_bedspace(Request $request)
    {

        // $room = DB::table('rooms')->where('id', $request->type)->first();
        $viewingYear = DB::table('settings')->value('viewing_year');

        if (BedSpace::where('room_number', $request->room_number)->where('room_id', '!=', $request->type)->where('year', $viewingYear)->first()) {
            $getBedSpace = BedSpace::where('room_number', $request->room_number)->first();
            return redirect()->back()->with('error', 'Room number (' . $request->room_number . ') already exist in ' . $getBedSpace->room->name . ', you can not assign the same room number on different room type (You can only assign ' . $request->room_number . ' to ' . $getBedSpace->room->name . ')');
        }

        if (BedSpace::where('room_id', $request->type)->where('room_number', $request->room_number)->where('name', $request->name)->where('year', $viewingYear)->first()) {

            return redirect()->back()->with('error', 'Bed Space already exist in ' . $request->room_number . ' on selected type');
        }
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'room_number' => 'required', //unique:bed_spaces
            'building_name' => 'required',
            // 'room_label' => 'required',
        ])->validate();

        $bedSpaces = BedSpace::create([
            'name' => $request->name,
            'room_id' => $request->type,
            'room_number' => $request->room_number,
            'building_name' =>  $request->building_name,
            'room_label' =>  $request->room_label,
            'year' => DB::table('settings')->value('current_year'),
        ]);
        return redirect('/bedspaces')->with('success', 'Bed space created successfully');
        // dd($bedSpaces);
    }

    function delete_bed_space($id)
    {

        BedSpace::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully');
    }

    function residents()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');

        if (request('sort') == 'expiring-65-days') {
            $residents = \App\Helpers\Rooms::expiredInDays(65, 35);
            // dd($residents);
        } elseif (request('sort') == 'expiring-35-days') {
            $residents = \App\Helpers\Rooms::expiredInDays(35, 0);
            // dd($residents);
        } elseif (request('sort') == 'expired') {
            $residents = \App\Helpers\Rooms::expired();
            //   dd($residents);
        } else {
            $residents = BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->get();
        }


        // dd($residents);
        return view('pages.residents')->with('residents', $residents);
    }

    function archived_rent()
    {
        $viewingYear = DB::table('settings')->value('viewing_year');

        if (request('sort') == 'expiring-65-days') {
            $residents = \App\Helpers\Rooms::expiredInDays(65, 35);
            // dd($residents);
        } elseif (request('sort') == 'expiring-35-days') {
            $residents = \App\Helpers\Rooms::expiredInDays(35, 0);
            // dd($residents);
        } elseif (request('sort') == 'expired') {
            $residents = \App\Helpers\Rooms::expired();
            //   dd($residents);
        } else {
            $residents = BedSpace::whereNotNull('user_id')->where('year', $viewingYear)->get();
        }


        // dd($residents);
        return view('pages.residents')->with('residents', $residents);
    }

    function residentDetails($id)
    {



        $resident = BedSpace::where('user_id', $id)->where('allocated', true)->first();

        // dd($residents);
        return view('pages.residents-details')->with('resident', $resident);
    }

    function updateDetails(Request $request, $id)
    {


        $request->photo =  User::where('id', $id)->value('photo');
        //    dd($request->all());
        if ($files = $request->file('photo')) {
            $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();
            $request->photo = $response;
        }
        User::where('id', $id)->update([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "gender" => $request->gender,
            "dob" => $request->dob,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "street" => $request->street,
            "city" => $request->city,
            // "country" => $request->country,
            "state" => $request->state,
            "school" => $request->school,
            "level" => $request->level,
            "course" => $request->course,
            "department" => $request->department,
            "faculty" => $request->faculty,
            "matric_number" => $request->matric_number,
            "g_suffix" => $request->g_suffix,
            "g_first_name" => $request->g_first_name,
            "g_last_name" => $request->g_last_name,
            "g_relationship" => $request->g_relationship,
            "g_email" => $request->g_email,
            "g_phone_number" => $request->g_phone_number,
            "g_street" => $request->g_street,
            "g_city" => $request->g_city,
            "g_state" => $request->g_state,
        ]);
        return redirect()->back()->with("success", "User Details updated!");
    }

    function get_room_details(Request $request)
    {
        $bed = ['<option>-Select Bed-</option>'];
        //where('room_id', $rent->room_id)->where('user_id', $rent->user_id)->orwhere('room_id', $rent->room_id)->whereNull('user_id')->where('allocated', false)->get()->unique('room_number')
        $bedSpace = BedSpace::where('room_id', $request->room_id)->where('room_number', $request->room_number)->where('user_id', $request->user_id)->orWhere('room_id', $request->room_id)->where('room_number', $request->room_number)->whereNull('user_id')->where('allocated', false)->get();
        foreach ($bedSpace as $view) {
            $bed[] = $view->user_id == $request->user_id ? '<option selected value="' . $view->id . '">' . $view->name . '</option>' : '<option value="' . $view->id . '">' . $view->name . '</option>';
        }

        $bedspace = $bed;

        // dd($request->all());

        return json_encode([
            'status' => 'success',
            'bedspace' => $bedspace,
            //    'current' => $sortbyRoom ?? '',
        ]);
    }
}
