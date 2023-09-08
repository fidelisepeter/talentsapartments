<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\BedSpace;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is.admin']);
    }

    public function get_rooms_by_locations(Request $request)
    {

        // <option disabled selected>--Room Type--</option>-->
        //         <!--                @foreach(DB::table('rooms')->where('location', $location->id)->get() as $room)-->
        //         <!--                  <option value="{{$room->id}}">{{$room->name}}</option>-->
        //         <!--                @endforeach-->

        $room_list = ['<option>--Room Type--</option>'];
        //where('room_id', $rent->room_id)->where('user_id', $rent->user_id)->orwhere('room_id', $rent->room_id)->whereNull('user_id')->where('allocated', false)->get()->unique('room_number')
        $rooms = DB::table('rooms')->where('location', $request->location)->get();
        foreach ($rooms as $room) {
            $room_list[] = '<option selected value="' . $room->id . '">' . $room->name . '</option>';
        }

        return json_encode([
            'status' => 'success',
            'room_list' => $room_list,
            //    'current' => $sortbyRoom ?? '',
        ]);
    }

    function room(Request $request)
    {
        $viewingYear = DB::table('settings')->value('viewing_year');
        $available_spece_count = 0;
        $getAll = [];
        $getAllAvailable = [];
        // $room_numbers = RoomNumber::orderBy('id', "DESC")->simplePaginate(10);
        $bedSpace = BedSpace::where('year', $viewingYear)->get()->unique('room_id');
        // $bedSpace = BedSpace::where('room_number', 'Room 221')->get()->unique('room_id');
        // dd(Room::all());
        foreach ($bedSpace as $view) {
            if ($request->search && $request->search != 'all') {
                $roomlist = BedSpace::where('room_id', $view->room->id)->where('room_number', $request->search)->where('year', $viewingYear)->get()->unique('room_number');
            } elseif ($request->search == 'all') {
                $roomlist = BedSpace::where('room_id', $view->room->id)->where('year', $viewingYear)->get()->unique('room_number');
            } else {
                $roomlist = BedSpace::where('room_id', $view->room->id)->where('year', $viewingYear)->get()->unique('room_number');
            }

            foreach ($roomlist as $list) {
                foreach (BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->where('year', $viewingYear)->get()->unique('room_number') as $roomView) {
                    $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
                    $roomView->bedspace_count = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->where('year', $viewingYear)->get()->count();
                    $resident_count = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('year', $viewingYear)->get()->count();
                    $get_residents = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('year', $viewingYear)->get();
                    // foreach(BedSpace::where('room_id', $roomView->room_id)->where('room_number', $roomView->room_number)->whereNotNull('user_id')->get() as $each){
                    //     // $getuser = '';
                    //     $getuser[] = $each->user_id;

                    // }
                    $roomView->resident = $get_residents;
                    $roomView->with_resident = $get_residents;
                    $roomView->resident_count = $resident_count;

                    $getAll[] =  $roomView;
                    $getFirst =  $roomView;
                }
            }

            foreach (BedSpace::where('room_id', $view->room->id)->where('year', $viewingYear)->get()->unique('room_number') as $list) {
                foreach (BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
                    $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
                    $bedspace_count = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->where('year', $viewingYear)->get()->count();
                    $roomView->bedspace_count = $bedspace_count;
                    $resident_count = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('year', $viewingYear)->get()->count();
                    $get_residents = BedSpace::where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('year', $viewingYear)->get();
                    $roomView->resident = $get_residents;
                    $roomView->with_resident = $get_residents;
                    $roomView->resident_count = $resident_count;

                    $available_spece = $bedspace_count - $resident_count;
                    if ($available_spece > 0) {
                        $available_spece_count++;
                        $getAllAvailable[] =  $roomView;
                        $getFirst =  $roomView;
                    }
                }
            }
        }

        // dd($getAll);

        return view('pages.room')->with([
            'rooms' => $getAll,
            'availableRooms' => $getAllAvailable,
            'available_spece_count' => $available_spece_count
        ]);
    }

    function roomTypes()
    {

        

        // $rooms = Room::where('year', DB::table('settings')->value('viewing_year'))->orderBy('id', "DESC")->simplePaginate(11);
        $perPage = 11;
        $currentPage = request()->get('page', 1);
        $data = Room::where('year', DB::table('settings')->value('viewing_year'))->get()->sortByDesc('available');
        $rooms = new \Illuminate\Pagination\LengthAwarePaginator(
            $data->forPage($currentPage, $perPage),
            $data->count(),
            $perPage,
            $currentPage,
            ['path' => 'room-types']
        );
       
        return view('pages.room-types')->with(['rooms' => $rooms]);
    }

    function ViewRoomTypes($id)
    {

        $room = Room::where('id', $id)->first();
        return view('pages.view-room-types')->with(['room' => $room]);
    }

    function roomTypesUpdate(Request $request, $id)
    {

        $room = Room::where('id', $id)->first();

        request()->validate([
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = $room->photo;

        if ($files = $request->file('photo')) {
            $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();
            $photo = $response;
        }


        DB::table('rooms')->where('id', $id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'amenity1' => $request->amenities[0] ?? '',
            'amenity2' => $request->amenities[1] ?? '',
            'amenity3' => $request->amenities[2] ?? '',
            'amenity4' => $request->amenities[3] ?? '',
            'amenity5' => $request->amenities[4] ?? '',
            'amenity6' => $request->amenities[5] ?? '',
            'amenity7' => $request->amenities[6] ?? '',
            'amenity8' => $request->amenities[7] ?? '',
            'amenity9' => $request->amenities[8] ?? '',
            'amenity10' => $request->amenities[9] ?? '',
            'location' => $request->input('location'),
             'show_in_site' => $request->show_in_site == 'on' ? true : false,
             'status' => $request->status == 'on' ? 'available' : 'unavailable',
            'detail' => $request->input('detail'),
            "photo" => $photo,
            // "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            'year' => DB::table('settings')->value('current_year')
        ]);
        return redirect()->back()->with('success', 'Data updated successfully');
    }

    function roomTypesDelete(Request $request, $id)
    {

        // dd($document);
        Room::where('id', $id)->delete();
        return redirect('/room-types')->with('success', 'Data has been deleted');
    }

    function roomList()
    {

        return view('pages.room-list');
    }

    function roomAmenities()
    {
        $amenities = DB::table('amenities')->where('year', DB::table('settings')->value('viewing_year'))->orderBy('id', "DESC")->get();
        return view('pages.amenities')->with(['amenities' => $amenities]);
    }

    function roomLocations()
    {
        $locations = DB::table('locations')->where('year', DB::table('settings')->value('viewing_year'))->orderBy('id', "DESC")->get();
        return view('pages.location')->with(['locations' => $locations]);
    }

    function buildings()
    {
        $buildings = DB::table('buildings')->where('year', DB::table('settings')->value('viewing_year'))->orderBy('id', "DESC")->get();
        return view('pages.buildings')->with(['buildings' => $buildings]);
    }

    public function create_room(Request $request)
    {

        //dd($request->all());
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $photo = "no image";

        if ($files = $request->file('photo')) {
            $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();
            $photo = $response;
        }

        $newRoom = DB::table('rooms')->insert([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'amenity1' => $request->amenities[0] ?? '',
            'amenity2' => $request->amenities[1] ?? '',
            'amenity3' => $request->amenities[2] ?? '',
            'amenity4' => $request->amenities[3] ?? '',
            'amenity5' => $request->amenities[4] ?? '',
            'amenity6' => $request->amenities[5] ?? '',
            'amenity7' => $request->amenities[6] ?? '',
            'amenity8' => $request->amenities[7] ?? '',
            'amenity9' => $request->amenities[8] ?? '',
            'amenity10' => $request->amenities[9] ?? '',
            'location' => $request->input('location'),
            //  'capacity' => $request->input('capacity'),
            //  'no_of_rooms' => $request->input('number_of_rooms'),
            'detail' => $request->input('detail'),
            "photo" => $photo,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            'year' => DB::table('settings')->value('current_year')
        ]);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function create_location(Request $request)
    {
        $newLocation = DB::table('locations')->insert([
            'name' => $request->input('name'),
            'state' => $request->input('state'),
            'year' => DB::table('settings')->value('current_year'),
        ]);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function create_building(Request $request)
    {
        $newLocation = DB::table('buildings')->insert([
            'name' => $request->input('name'),
            'year' => DB::table('settings')->value('current_year'),
            // 'state' => $request->input('state'),
        ]);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function delete_location($id)
    {
        $delLocation = DB::table('locations')->delete($id);
        return redirect()->back()->with('success', 'Data deleted successfully');
    }

    public function delete_amenities($id)
    {
        $delamenities = DB::table('amenities')->delete($id);
        return redirect()->back();
    }


    public function delete_buildings($id)
    {
        $delbuildings = DB::table('buildings')->delete($id);
        return redirect()->back();
    }


    function changeStatus($id)
    {
        $room = DB::table('rooms')->where('id', $id)->first();
        if ($room->status == 'available') {
            DB::table('rooms')->where('id', $id)->update(['status' => 'unavailable']);
        } else {
            DB::table('rooms')->where('id', $id)->update(['status' => 'available']);
        }
        return redirect()->back();
    }

    function deleteRoom($id)
    {
        DB::table('rooms')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully');
    }
}
