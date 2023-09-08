<?php
namespace App\Helpers\SampleRoutes;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;
use DarkGhostHunter\Larapass\Facades\WebAuthn;

/*
|--------------------------------------------------------------------------
| Sample Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/au', function (Request $request) {

    // Find the user to assert, if there is any
// $user = User::where('email', Auth::user()->email)->first();
$user = User::where('id', Auth::id())->first();
// Create an assertion for the given user (or a blank one if not found);
return WebAuthn::generateAttestation($user);
// $user = User::where('id', Auth::id())->first();

// // Create an attestation for a given user.
// WebAuthn::generateAttestation($user);


// // Verify it
// $credential = WebAuthn::validateAttestation(
//     request()->json()->all(), $user
// );

// // And save it.
// if ($credential) {
//     $user->addCredential($credential);
// } else {
//     return 'Something went wrong with your device!';
// }
// return view('welcome');
});

Route::get('/update-location', function (Request $request) {

    foreach(DB::table('login_details')->get() as $user){
        $details = json_encode([
            'location' => Location::get($user->ip_address) !== false ? Location::get($user->ip_address) : [],
        ]);
        DB::table('login_details')->where('ip_address', $user->ip_address)->update([
            'details' => $details,
        ]);
    };
});