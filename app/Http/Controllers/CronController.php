<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function App\View\Components\send_mail;

class CronController extends Controller
{
    public function rentExpiringIn($init = 35)
    {

        //One hour is added to compensate for PHP being one hour faster
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        logger($now);

        $rents = Rent::get();

        if ($rents !== null) {

            

            $rents->whereNotNull('expiring_date')
                    ->whereBetween(
                        'expiring_date',
                        [
                            \Carbon\Carbon::now(),
                            \Carbon\Carbon::now()
                                ->addDays($init)
                        ]
                    )
                    ->each(function ($rent) {

                        $user = DB::table('users')->where('id', $rent->user_id)->first();
                        Log::info('Rent Notification of '.\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($rent->expiring_date)).' days(expiring) sent to '.$user->first_name.' '.$user->last_name.'('.$user->email.')');
                       

                    $input = ['[first_name]', '[last_name]', '[middle_name]', '[expiring_date]', '[auth]'];
                    $outfilled = [$user->first_name ?? '', $user->last_name ?? '', $user->middle_name ?? '', \Carbon\Carbon::parse($rent->expiring_date)->format('j M, Y'), ''];
                    $message =  str_replace($input, $outfilled,  DB::table('settings')->value('rent_expiring_message'));
               
                     send_mail($user->first_name, $user->email, 'Rent Expiring Date is Close', $message);
                        

                
            });
        }
    }


    public function rentExpired()
    {

        //One hour is added to compensate for PHP being one hour faster
        $now = \Carbon\Carbon::parse(date("Y-m-d", strtotime(\Carbon\Carbon::now()->addHour())).' 00:00:00');
        
        logger($now);

        $rents = Rent::get();

        if ($rents !== null) {

            

            $rents->whereNotNull('expiring_date')
                    // ->where(
                    //     'expiring_date',
                    //     $now
                    // )
                    ->whereBetween(
                        'expiring_date',
                        [
                            \Carbon\Carbon::now()->subDay(),
                            \Carbon\Carbon::now()
                        ]
                    )
                    ->each(function ($rent) {

                        $user = DB::table('users')->where('id', $rent->user_id)->first();
                        Log::info('Expired Rent Notification sent to '.$user->first_name.' '.$user->last_name.'('.$user->email.')');
                       
                       

                    $input = ['[first_name]', '[last_name]', '[middle_name]', '[expiring_date]', '[auth]'];
                    $outfilled = [$user->first_name ?? '', $user->last_name ?? '', $user->middle_name ?? '', \Carbon\Carbon::parse($rent->expiring_date)->format('j M, Y'), ''];
                    $message =  str_replace($input, $outfilled,  DB::table('settings')->value('rent_expired_message'));
               
                     send_mail($user->first_name, $user->email, 'Rent Expired', $message);
                        

                
            });
        }
    }
    public function fire(){

        $this->rentExpiringIn(65);
        $this->rentExpired();
        

    }
}
