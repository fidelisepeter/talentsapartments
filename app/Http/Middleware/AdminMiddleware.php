<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SettingsController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // User role
        $role = Auth::user()->role;

        // Check user role
        // if($role != 'super_admin' || $role != 'admin' ||  $role != 'complains_manager' || $role != 'accountant')
        // if (!in_array($role, array('super_admin', 'admin', 'complains_manager','accountant'))){

        //         return redirect('profile')->with('authError', 'You dont Have Access to that page!!!!');
        // }
        if ($role == 'student' or $role == 'lawyer') {


            return redirect('profile')->with('authError', 'You dont Have Access to that page!!!!');
        }
        // dd($request->headers);



        if ($request->headers->get('referer') == url('/login')) {
            $settings = new SettingsController();
            $browser = $settings->getBrowser();
            $details = json_encode([
                'location' => Location::get($request->ip()) !== false ? Location::get($request->ip()) : [],
            ]);
            DB::table('login_details')->insert([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'page' => $request->url(),
                'referrer' => $request->headers->get('referer'),
                'user_agent' => $request->headers->get('user-agent'),
                'browser' => $browser['name'] . " (version " . $browser['version'] . ") on " . $browser['platform'],
                'year' => DB::table('settings')->value('current_year'),
                'details' => $details,
            ]);
        }

        return $next($request);
    }
}
