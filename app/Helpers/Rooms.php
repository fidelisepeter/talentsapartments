<?php

namespace App\Helpers;

use App\Models\BedSpace;
use Illuminate\Support\Facades\DB;

class Rooms
{
    public $getDetails;

    public $getDetails2;

    public static $expired_in_months = 1;


    public function __construct()
    {
        // $users = DB::table('rooms')->get();

        // $users = DB::table('rooms')->get();

        // foreach ($users as $room) {
        //     $rent_count = DB::table('rents')->where('room_id', $room->id)->count(); // 5
        //     $capacity = $room->capacity;
        //     $avalaible = ($capacity - $rent_count);
        //     if($avalaible > 0){
        //         $available_capacity = 1;
        //     }
        //     $available_capacity++;
        //     // $room->available_capacity = 4;
        //     // //    print_r($room);

        // }
        // echo  $available_capacity;
    }

    public static function roomsAvalaible()
    {


        $available_spece_count = 0;
        $getAllAvailable = [];
        // $room_numbers = RoomNumber::orderBy('id', "DESC")->simplePaginate(10);
        $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        foreach ($bedSpace as $view) {
            //     foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
            //         foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
            //             $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
            //             $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
            //             $roomView->bedspace_count = $bedspace_count;
            //             $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get()->count();
            //             $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get();
            //             $roomView->resident = $get_residents;
            //             $roomView->with_resident = $get_residents;
            //             $roomView->resident_count = $resident_count;


            //             $available_spece = $bedspace_count - $resident_count;
            //             if ($available_spece > 0) {
            //                 $available_spece_count++;
            //                 $getAllAvailable[] =  $roomView;
            //             }


            //             // $getAllAvailable[] =  $roomView;
            //             // $getFirst =  $roomView;
            //         }
            //     }

            foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
                foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
                    $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
                    $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
                    $roomView->bedspace_count = $bedspace_count;
                    $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get()->count();
                    $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get();
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
        return  $getAllAvailable;
    }

    public static function roomsTaken()
    {

        $available_spece_count = 0;
        $getAllTaken = [];
        // $room_numbers = RoomNumber::orderBy('id', "DESC")->simplePaginate(10);
        $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        foreach ($bedSpace as $view) {
            // foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
            //     foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
            //         $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
            //         $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
            //         $roomView->bedspace_count = $bedspace_count;
            //         $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get()->count();
            //         $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get();

            //         $roomView->resident = $get_residents;
            //         $roomView->with_resident = $get_residents;
            //         $roomView->resident_count = $resident_count;

            //         $available_spece = $bedspace_count - $resident_count;
            //         if ($available_spece == 0) {
            //             $available_spece_count++;
            //             $getAllTaken[] =  $roomView;
            //         }




            //         $getFirst =  $roomView;
            //     }

            foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
                foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
                    $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
                    $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
                    $roomView->bedspace_count = $bedspace_count;
                    $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get()->count();
                    $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get();
                    $roomView->resident = $get_residents;
                    $roomView->with_resident = $get_residents;
                    $roomView->resident_count = $resident_count;


                    $available_spece = $bedspace_count - $resident_count;
                    if ($available_spece == 0) {
                        $available_spece_count++;
                        $getAllTaken[] =  $roomView;
                    }
                }
            }
        }
        return $getAllTaken ?? [];
    }

    public static function allRooms($type = null)
    {
        $get = [];
        if ($type != null) {
            $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->where('room_id', $type)->unique('room_id');
        } else {
            $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        }

        foreach ($bedSpace as $space) {
            $spacelist = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $space->room->id)->get()->unique('room_number');
            foreach ($spacelist as $list) {

                foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $space->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $show) {
                    $show->display_name = $show->room->name . ' - ' . $show->room_number;
                    // $get = new stdClass();
                    $get[] =  $show;
                }
            }
        }
        return  $get;
    }

    // public static function allAvailableRooms()
    // {
    //     $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
    //     foreach($bedSpace as $space){
    //         $spacelist = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->whereNull('user_id')->where('room_id', $space->room->id)->get()->unique('room_number');
    //         foreach($spacelist as $list){

    //             foreach(BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $space->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $show){ 
    //                 $show->display_name = $show->room->name.' - '.$show->room_number;
    //                 // $get = new stdClass();
    //                 $get[] =  $show;
    //             }

    //         }
    //     }
    //     return  $get;
    // }

    public static function roomsEmpty()
    {
        // $rooms = DB::table('rooms')->get();
        // $empty = 0;
        // foreach ($rooms as $room) {
        //     $rent_count = DB::table('rents')->where('room_id', $room->id)->count(); // 5
        //     $capacity = $room->capacity;
        //     $avalaible = ($capacity - $rent_count);

        //     if ($rent_count < 1) {
        //         $empty++;
        //     }
        // }
        // return  $empty;

        $available_spece_count = 0;
        $getAllTaken = [];
        // $room_numbers = RoomNumber::orderBy('id', "DESC")->simplePaginate(10);
        $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        foreach ($bedSpace as $view) {
            // foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
            //     foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
            //         $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
            //         $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
            //         $roomView->bedspace_count = $bedspace_count;
            //         $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get()->count();
            //         $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->where('allocated', false)->get();

            //         $roomView->resident = $get_residents;
            //         $roomView->with_resident = $get_residents;
            //         $roomView->resident_count = $resident_count;

            //         $available_spece = $bedspace_count - $resident_count;
            //         if ($available_spece == $bedspace_count) {
            //             $available_spece_count++;
            //             $getAllTaken[] =  $roomView;
            //         }
            //         $getFirst =  $roomView;
            //     }
            // }

            foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->get()->unique('room_number') as $list) {
                foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $roomView) {
                    $roomView->display_name = $roomView->room->name . ' - ' . $roomView->room_number;
                    $bedspace_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->get()->count();
                    $roomView->bedspace_count = $bedspace_count;
                    $resident_count = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get()->count();
                    $get_residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $view->room->id)->where('room_number', $list->room_number)->whereNotNull('user_id')->get();
                    $roomView->resident = $get_residents;
                    $roomView->with_resident = $get_residents;
                    $roomView->resident_count = $resident_count;


                    $available_spece = $bedspace_count - $resident_count;
                    if ($available_spece == $bedspace_count) {
                        $available_spece_count++;
                        $getAllTaken[] =  $roomView;
                    }
                }
            }
        }
        return $getAllTaken;
    }

    public function months($init = 1)
    {

        self::$expired_in_months = $init;

        return $this;
    }

    public static function expiredInMouths($init = 1, $room_id = null)
    {
        $rentByMonth = [];
        $residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->whereNotNull('user_id')->get();
        foreach ($residents as $resident) {
            if (isset($resident->rent->expiring_date)) {
                $rent  = $resident->rent()->whereNotNull('expiring_date')
                    ->whereBetween(
                        'expiring_date',
                        [
                            \Carbon\Carbon::now(),
                            \Carbon\Carbon::now()
                                ->addMonths($init)
                        ]
                    )
                    ->first();
                $rentByMonth[] = $resident;
            }
        }
        return  $rentByMonth;
    }

    public static function bedSpace($type = null)
    {
        $get = [];
        if ($type != null) {
            $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->where('room_id', $type)->unique('room_id');
        } else {
            $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        }

        // $bedSpace = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_id');
        foreach ($bedSpace as $space) {
            $spacelist = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $space->room->id)->get()->unique('room_number');
            foreach ($spacelist as $list) {

                foreach (BedSpace::where('year', DB::table('settings')->value('viewing_year'))->where('room_id', $space->room->id)->where('room_number', $list->room_number)->get()->unique('room_number') as $show) {
                    $show->display_name = $show->room->name . ' - ' . $show->room_number;
                    // $get = new stdClass();
                    $get[] =  $show;
                }
            }
        }
        return  $get;
    }

    public static function expiredInDays($start = 31, $end = 1, $room_id = null)
    {
        $rentByDays = [];

        $residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->whereNotNull('user_id')->get();
        foreach ($residents as $resident) {
            if (isset($resident->rent->expiring_date)) {
                $rent  = $resident->rent()->whereNotNull('expiring_date')
                    ->whereBetween(
                        'expiring_date',
                        [
                            \Carbon\Carbon::now()
                            ->addDays($end),
                            \Carbon\Carbon::now()
                                ->addDays($start)
                        ]
                    )
                    ->first();
                if ($rent != null) {
                    $rentByDays[] = $resident;
                }
            }
        }

        return  $rentByDays;
    }

    public static function expired()
    {
        $expired = [];

        $residents = BedSpace::where('year', DB::table('settings')->value('viewing_year'))->whereNotNull('user_id')->get();
        foreach ($residents as $resident) {
            if (isset($resident->rent->expiring_date)) {
                $rent  = $resident->rent()->whereNotNull('expiring_date')
                    ->first();
                if ($rent->expiring_date < \Carbon\Carbon::now()) {
                    $expired[] = $resident;
                }
            }
        }

        return  $expired;
    }
}
