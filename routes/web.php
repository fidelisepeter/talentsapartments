<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use Laragear\WebAuthn\WebAuthn;
use App\View\Components\SENDMAIL;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PromoController;

use App\Http\Controllers\StaffController;
use function App\View\Components\sendPdf;
use App\Http\Controllers\LawyerController;

use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use function App\View\Components\send_mail;
use App\Http\Controllers\BedSpaceController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\SettingsController;
use Laragear\WebAuthn\Models\WebAuthnCredential;
use function App\View\Components\createNotification;
use Laragear\WebAuthn\Http\Requests\AttestedRequest;
use App\Http\Controllers\Auth\WebAuthnLoginController;
use App\Http\Controllers\Auth\WebAuthnRegisterController;
use Laragear\WebAuthn\Assertion\Validator\AssertionValidator;
use Laragear\WebAuthn\Assertion\Validator\AssertionValidation;
use Laragear\WebAuthn\Attestation\Validator\AttestationValidation;

// include '../app/Helpers/SampleRoutes.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/webauthn/register3', function (Request $request, WebAuthnCredential $credential, AssertionValidator $assertion, Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable $user) {

    $credential = $assertion->send(new AttestationValidation($user, $request))->thenReturn()->credential;
    // ->then(static function (AttestationValidation $validation): WebAuthnCredential {
    //     // return $validation->credential;

    // });

    // $this->credential = $this->container->make(AttestationValidator::class)
    //         ->send(new AttestationValidation($this->user(), $this))
    // ->then(static function (AttestationValidation $validation): WebAuthnCredential {
    //     return $validation->credential;
    // });

    dd($request->container);
});

Route::get('/webauthn/register2', function (AttestedRequest $request) {
    $request->save();
    return response()->noContent();
    // dd($request);
});



Route::get('/au', function (Request $request) {


    return view('welcome');
});

Route::get('/p', function () {


    Permission::create(['name' => 'create-inventory']);
    Permission::create(['name' => 'update-inventory']);
    Permission::create(['name' => 'view-inventory']);
    Permission::create(['name' => 'delete-inventory']);
});


// WebAuthn Routes
WebAuthn::routes();
Auth::routes();

//Staff Routes 
Route::post('/staff/match', [\App\Http\Controllers\StaffController::class, 'match']);
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::post('/staff/{user}/role/change', [\App\Http\Controllers\StaffController::class, 'store'])->middleware('can:edit-staff');
    Route::get('/staff', [\App\Http\Controllers\StaffController::class, 'index'])->middleware('can:view-staff');
    // Route::post('/staff/match', [\App\Http\Controllers\StaffController::class, 'match'])->withoutMiddleware(['auth', 'is.admin']);
    Route::get('/staff/create', [\App\Http\Controllers\StaffController::class, 'create'])->middleware('can:create-staff');
    Route::post('/staff/save', [\App\Http\Controllers\StaffController::class, 'store'])->middleware('can:create-staff');
    Route::get('/staff/{user}', [\App\Http\Controllers\StaffController::class, 'show'])->middleware('can:view-staff');
    Route::get('/staff/{user}/edit', [\App\Http\Controllers\StaffController::class, 'edit'])->middleware('can:edit-staff');
    Route::post('/staff/{user}/update', [\App\Http\Controllers\StaffController::class, 'update'])->middleware('can:edit-staff');
    Route::post('/staff/{user}/update-details', [\App\Http\Controllers\StaffController::class, 'update_details'])->middleware('can:edit-staff');
    Route::post('/staff/{user}/update-password', [\App\Http\Controllers\StaffController::class, 'update_password'])->middleware('can:edit-staff');
    Route::get('/staff/{user}/permissions', [\App\Http\Controllers\StaffController::class, 'permissions'])->middleware(['can:edit-staff', 'can:edit-permission-for-staff']);
    Route::post('/staff/{user}/permission/update', [\App\Http\Controllers\StaffController::class, 'update_permission'])->middleware(['can:edit-staff', 'can:edit-permission-for-staff']);
    Route::post('/staff/{user}/supervisor/update', [\App\Http\Controllers\StaffController::class, 'update_supervisor'])->middleware('can:edit-staff');
    Route::post('/staff/{user}/department/update', [\App\Http\Controllers\StaffController::class, 'update_department'])->middleware('can:edit-staff');
    Route::post('/staff/{user}/role/update', [\App\Http\Controllers\StaffController::class, 'update_role'])->middleware('can:edit-staff');
    Route::delete('/staff/{user}', [\App\Http\Controllers\StaffController::class, 'destroy'])->middleware('can:delete-staff');
    Route::get('/staff/{user}/login-reports', [\App\Http\Controllers\StaffController::class, 'login_reports'])->middleware('can:view-staff');
});

//DEPARTMENT ROUTE
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/department', [\App\Http\Controllers\DepartmentController::class, 'index'])->middleware('can:view-department');
    Route::get('/department/create', [\App\Http\Controllers\DepartmentController::class, 'create'])->middleware('can:create-department');
    Route::post('/department/store', [\App\Http\Controllers\DepartmentController::class, 'store'])->middleware('can:create-department');
    Route::get('/department/{department}', [\App\Http\Controllers\DepartmentController::class, 'show'])->middleware('can:view-department');
    Route::get('/department/{user}/delete', [\App\Http\Controllers\DepartmentController::class, 'destroy'])->middleware('can:edit-department');
    Route::post('/department/{department}/update', [\App\Http\Controllers\DepartmentController::class, 'update'])->middleware('can:edit-department');

    // Route::get('/department', [\App\Http\Controllers\DepartmentController::class, 'create'])->middleware('can:create-department');

});

//Guest Routes
Route::middleware(['auth', 'is.admin'])->group(function () {

    Route::get('/guest', [\App\Http\Controllers\GuestController::class, 'index'])->middleware('can:view-guests');
    Route::get('/guest-awaiting', [\App\Http\Controllers\GuestController::class, 'index_awaiting'])->middleware('can:view-guests');
    Route::get('/guest-ongoing', [\App\Http\Controllers\GuestController::class, 'index_ongoing'])->middleware('can:view-guests');
    Route::get('/guest-closed', [\App\Http\Controllers\GuestController::class, 'index_closed'])->middleware('can:view-guests');
    Route::get('/guest/code-page', [\App\Http\Controllers\GuestController::class, 'code_page'])->middleware('can:view-guests');
    Route::get('/guest/settings', [\App\Http\Controllers\GuestController::class, 'settings'])->middleware('can:edit-guest-settings');
    Route::post('/guest/settings/update', [\App\Http\Controllers\GuestController::class, 'update_settings'])->middleware('can:edit-guest-settings');
    Route::get('/resident/{user}/guest', [\App\Http\Controllers\GuestController::class, 'show_all'])->middleware('can:view-guests');
    Route::get('/resident/{user}/guest/{guest}', [\App\Http\Controllers\GuestController::class, 'show'])->middleware('can:view-guests');
    Route::get('/guest/{guest}/delete', [\App\Http\Controllers\GuestController::class, 'destroy'])->middleware('can:delete-guests');
    Route::post('/guest/{guest}/signing', [\App\Http\Controllers\GuestController::class, 'update'])->middleware(['can:sign-in-guests', 'can:sign-out-guests']);


    Route::get('/guest/create', [\App\Http\Controllers\GuestController::class, 'create'])->middleware('is.verified')->withoutMiddleware('is.admin');
    Route::post('/guest/store', [\App\Http\Controllers\GuestController::class, 'store'])->middleware('is.verified')->withoutMiddleware('is.admin');
    Route::get('/my-guest', [\App\Http\Controllers\GuestController::class, 'user_guest'])->middleware('is.verified')->withoutMiddleware('is.admin');
    Route::get('/my-guest/{guest}', [\App\Http\Controllers\GuestController::class, 'user_guest_view'])->middleware('is.verified')->withoutMiddleware('is.admin');
    Route::get('/my-guest/{guest}/delete', [\App\Http\Controllers\GuestController::class, 'user_guest_delete'])->middleware('is.verified')->withoutMiddleware('is.admin');
});

//Roles Routes
Route::middleware(['auth', 'is.admin'])->group(function () {

    Route::get('/role', [\App\Http\Controllers\RoleController::class, 'index'])->middleware('can:view-roles');
    Route::post('/role/create', [\App\Http\Controllers\RoleController::class, 'create'])->middleware('can:create-roles');
    Route::get('/role/{role}', [\App\Http\Controllers\RoleController::class, 'show'])->middleware('can:view-roles');
    Route::post('/role/{role}/permissions/update', [\App\Http\Controllers\RoleController::class, 'permissions'])->middleware('can:edit-roles');
    Route::post('/role/{role}/update', [\App\Http\Controllers\RoleController::class, 'update'])->middleware('can:edit-roles');
    Route::post('/role/store', [\App\Http\Controllers\RoleController::class, 'store'])->middleware('can:create-roles');
    Route::delete('/role/{id}', [\App\Http\Controllers\RoleController::class, 'destroy'])->middleware('can:edit-roles');
});


//Lawyer Route
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::post('/lawyer/{user}/role/change', [\App\Http\Controllers\LawyerController::class, 'store'])->middleware('can:edit-staff');
    Route::get('/lawyer', [\App\Http\Controllers\LawyerController::class, 'index'])->middleware('can:view-staff');
    // Route::get('/lawyer/reports', [\App\Http\Controllers\LawyerController::class, 'report'])->withoutMiddleware(['auth', 'is.admin']);
    Route::get('/lawyer/create', [\App\Http\Controllers\LawyerController::class, 'create'])->middleware('can:create-staff');
    Route::post('/lawyer/save', [\App\Http\Controllers\LawyerController::class, 'store'])->middleware('can:create-staff');
    Route::get('/lawyer/{user}', [\App\Http\Controllers\LawyerController::class, 'show'])->middleware('can:view-staff');
    Route::get('/lawyer/{user}/edit', [\App\Http\Controllers\LawyerController::class, 'edit'])->middleware('can:edit-staff');
    Route::post('/lawyer/{user}/update', [\App\Http\Controllers\LawyerController::class, 'update'])->middleware('can:edit-staff');
    Route::get('/lawyer/{user}/permissions', [\App\Http\Controllers\LawyerController::class, 'permissions'])->middleware('can:edit-staff');
    Route::post('/lawyer/{user}/permission/update', [\App\Http\Controllers\LawyerController::class, 'update_permission'])->middleware('can:edit-staff');
    Route::post('/lawyer/{user}/supervisor/update', [\App\Http\Controllers\LawyerController::class, 'update_supervisor'])->middleware('can:edit-staff');
    Route::post('/lawyer/{user}/department/update', [\App\Http\Controllers\LawyerController::class, 'update_department'])->middleware('can:edit-staff');
    Route::post('/lawyer/{user}/role/update', [\App\Http\Controllers\LawyerController::class, 'update_role'])->middleware('can:edit-staff');
    Route::delete('/lawyer/{user}', [\App\Http\Controllers\LawyerController::class, 'destroy'])->middleware('can:delete-staff');
    Route::get('/lawyer/{user}/login-reports', [\App\Http\Controllers\LawyerController::class, 'login_reports'])->middleware('can:view-staff');
    Route::post('/profile/settings/new_document_email_notification', [\App\Http\Controllers\LawyerController::class, 'new_document_email_notification'])->middleware(['can:view-document', 'can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
});


//Document Route
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::post('/document/{document}/role/change', [\App\Http\Controllers\DocumentController::class, 'store'])->middleware('can:edit-document');

    // Route::resource('/document', '\App\Http\Controllers\DocumentController'); ->middleware(['auth', 'is.verified'])
    Route::get('/document', [\App\Http\Controllers\DocumentController::class, 'index'])->middleware('can:view-document');
    Route::get('/document/print/{document}/user/{user}', [\App\Http\Controllers\DocumentController::class, 'print'])->withoutMiddleware(['auth', 'is.admin']);
    Route::get('/document/create', [\App\Http\Controllers\DocumentController::class, 'create'])->middleware('can:create-document');
    Route::post('/document/store', [\App\Http\Controllers\DocumentController::class, 'store'])->middleware('can:create-document');
    Route::get('/document/{document}', [\App\Http\Controllers\DocumentController::class, 'show'])->middleware('can:view-document');
    Route::get('/document/{document}/delete', [\App\Http\Controllers\DocumentController::class, 'destroy'])->middleware('can:delete-document');
    Route::post('/document/{document}/update-user-data/{user}', [\App\Http\Controllers\DocumentController::class, 'update_user_data'])->middleware('can:edit-document');
    Route::post('/document/{document}/update', [\App\Http\Controllers\DocumentController::class, 'update'])->middleware('can:edit-document');
    Route::get('/resident/{user}/documents', [\App\Http\Controllers\DocumentController::class, 'resident_documents'])->middleware('can:edit-document');
    Route::get('/resident/{user}/document/{document}', [\App\Http\Controllers\DocumentController::class, 'resident_document'])->middleware('can:edit-document');
    Route::get('/document/user/{user}', [\App\Http\Controllers\DocumentController::class, 'user_documents'])->middleware('can:edit-document')->withoutMiddleware(['is.admin']);
    Route::post('/resident/{user}/update/{document}', [\App\Http\Controllers\DocumentController::class, 'update_user_document'])->middleware('can:edit-document');
    Route::delete('/document/{document}', [\App\Http\Controllers\DocumentController::class, 'destroy'])->middleware('can:delete-document');
    Route::post('/document/{document}/update-user-data/{user}', [\App\Http\Controllers\DocumentController::class, 'update_user_data'])->middleware(['can:view-document', 'can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
    Route::get('/resident/{user}/view/{document}', [\App\Http\Controllers\DocumentController::class, 'user_document'])->middleware(['can:view-document', 'can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
    Route::get('/document/agreement-forms/users/{user}', [\App\Http\Controllers\DocumentController::class, 'user_agreement_forms'])->middleware(['can:edit-document', 'can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
    Route::get('/assigned-documents/', [\App\Http\Controllers\DocumentController::class, 'assigned_documents'])->middleware(['can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
    Route::get('/document/list/users/', [\App\Http\Controllers\DocumentController::class, 'user_list'])->middleware(['can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
    Route::get('/document/agreement-forms/users/', [\App\Http\Controllers\DocumentController::class, 'agreement_forms'])->middleware(['can:view-document', 'can:stamp-document', 'can:sign-document'])->withoutMiddleware('is.admin');
});



//STUDENT AUTH Route
Route::middleware(['auth', 'is.verified'])->group(function () {
    Route::post('/room-mate-code', [StudentController::class, 'room_mate_code']);
    Route::post('/add-review', [StudentController::class, 'add_review']);
    Route::get('/user-details/{id}', [\App\Http\Controllers\StudentController::class, 'user_details'])->withoutMiddleware('is.verified');
    Route::get('/billings', [StudentController::class, 'billings']);
    Route::get('/purchase/booking/{rent}', [StudentController::class, 'pay_booking'])->withoutMiddleware('is.verified');
    Route::get('/room', [StudentController::class, 'room']);
    Route::post('verify_email', [StudentController::class, 'verifyEmail'])->withoutMiddleware('is.verified');
    Route::post('updatepassword', [StudentController::class, 'changePassword'])->name('profile.updatePassword');
    Route::post('updatepersonalinfo', [StudentController::class, 'update_personal_info'])->name('profile.updatepersonalinfo');
    Route::get('personal_info', [StudentController::class, 'personal_info'])->withoutMiddleware('is.verified');
    Route::post('save_personal_info', [StudentController::class, 'save_personal_info'])->withoutMiddleware('is.verified');
    Route::get('guardian_info', [StudentController::class, 'guardian_info'])->withoutMiddleware('is.verified');
    Route::post('save_guardian_info', [StudentController::class, 'save_guardian_info'])->withoutMiddleware('is.verified');
    Route::get('send_guarantor_form/{user_id}', [StudentController::class, 'send_guarantor_form']);
    Route::post('new-complaint', [StudentController::class, 'complain']);
    Route::get('upkeep', [StudentController::class, 'upkeep']);
    Route::get('/upkeep/complain/{complain}', [StudentController::class, 'upkeep_messages']);
    Route::get('/upkeep/complain/{complain}/satisfactory/completed', [StudentController::class, 'satisfactory_completed']);
    Route::post('/upkeep/complain/{complain}/satisfactory/message', [StudentController::class, 'satisfactory_message']);
    Route::get('/rentals', [StudentController::class, 'rentals']);
    Route::get('/invoice/{application_no}', [StudentController::class, 'invoice']);
    Route::post('/send_message', [StudentController::class, 'message']);
    Route::get('/services', [StudentController::class, 'services']);
    Route::post('/add_consent/{user}', [StudentController::class, 'add_consent']);
    Route::post('/create_product_invoice/{product_uid}', [StudentController::class, 'create_product_invoice']);
    Route::get('services/purchase/__product/{uid}/invoice/{application_no}', [StudentController::class, 'purchase_product']);
    Route::get('add_user_service/{uid}/invoice/{application_no}/', [StudentController::class, 'add_user_service']);
});



//SETTINGS ROUTE
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/settings', [\App\Http\Controllers\SettingsController::class, 'profile_settings']);
    Route::get('/profile', [\App\Http\Controllers\SettingsController::class, 'profile']);
    Route::get('get-login-page-data', [SettingsController::class, 'login_page_data']);
    Route::post('profile/{user}/biometrics-options', [SettingsController::class, 'biometrics_options']);
    //Disable, Enable, & Delete
    Route::get('profile/{user}/enable-device/{credential}', [SettingsController::class, 'enable_device']);
    Route::get('profile/{user}/disable-device/{credential}', [SettingsController::class, 'disable_device']);
    Route::get('profile/{user}/delete-device/{credential}', [SettingsController::class, 'delete_device']);

    Route::post('profile/update-settings', [SettingsController::class, 'update']);
    Route::post('profile/update-password', [SettingsController::class, 'update_password']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contacts', [HomeController::class, 'contacts']);
Route::get('/locations', [HomeController::class, 'locations']);
Route::get('/product-page', [HomeController::class, 'product_page']);
Route::get('/application/{application_no}', [HomeController::class, 'application']);
Route::post('/application_setup', [HomeController::class, 'application_setup']);
Route::get('/confirm_payment', [HomeController::class, 'confirm_payment']);
Route::get('/await_verification', [HomeController::class, 'await_verification']);
Route::get('/get_keys', [HomeController::class, 'get_keys']);
Route::get('/new_payment', [HomeController::class, 'new_payment']);
Route::get('/change_notification_status', [HomeController::class, 'change_notification_status']);
Route::post('/change_room_type', [HomeController::class, 'change_room_type']);
Route::post('/call-me-back', [HomeController::class, 'call_me_back']);
Route::get('/get_rooms_by_locations', [HomeController::class, 'get_rooms_by_locations']);
Route::get('/get_room_by_id', [HomeController::class, 'get_room_by_id']);
Route::post('/create_invoice', [HomeController::class, 'create_invoice']);
Route::get('/get_invoice/{application_no}', [HomeController::class, 'get_invoice']);
Route::get('/confirm_bank_transfer/{application_no}', [HomeController::class, 'confirm_bank_transfer']);
Route::get('/confirm_online_payment/{transaction_id}', [HomeController::class, 'confirm_online_payment']);
Route::post('/send_payment_info', [HomeController::class, 'send_payment_info']);
Route::get('/admin_login', [HomeController::class, 'admin_login']);
Route::post('/send_contact_mail', [HomeController::class, 'send_contact_mail']);


//Room

Route::get('/rooms', [RoomController::class, 'room'])->middleware('can:view-rooms');
Route::get('/residents', [BedSpaceController::class, 'residents'])->middleware('can:view-residents');
Route::get('/resident/{id}', [BedSpaceController::class, 'residentDetails'])->middleware('can:view-residents');
Route::post('/update-resident/{id}', [BedSpaceController::class, 'updateDetails'])->middleware('can:edit-residents');
Route::get('/room-types', [RoomController::class, 'roomTypes'])->middleware('can:view-room-types');
Route::get('/room-types/{id}', [RoomController::class, 'ViewRoomTypes'])->middleware('can:view-room-types');
Route::post('/room-types/{id}/update', [RoomController::class, 'roomTypesUpdate'])->middleware('can:edit-room-types');
Route::get('/room-types/{id}/delete', [RoomController::class, 'roomTypesDelete'])->middleware('can:delete-room-types');
Route::get('/room-list', [RoomController::class, 'roomList'])->middleware('can:view-rooms');
Route::get('/room/status/{id}', [RoomController::class, 'changeStatus'])->middleware('can:edit-rooms');
Route::get('/room/delete/{id}', [RoomController::class, 'deleteRoom'])->middleware('can:delete-rooms');
Route::post('/create_room', [RoomController::class, 'create_room'])->middleware('can:create-rooms');
Route::post('/create_location', [RoomController::class, 'create_location'])->middleware('can:create-locations');
Route::post('/create_building', [RoomController::class, 'create_building'])->middleware('can:create-buildings');
Route::get('/delete_location/{id}', [RoomController::class, 'delete_location'])->middleware('can:delete-locations');
Route::get('/delete_amenities/{id}', [RoomController::class, 'delete_amenities'])->middleware('can:delete-amenities');
Route::get('/delete_building/{id}', [RoomController::class, 'delete_buildings'])->middleware('can:delete-buildings');
Route::match(['get', 'post'], '/bedspaces', [BedSpaceController::class, 'index'])->middleware('can:view-bedspace');
Route::get('/bedspace/{id}', [BedSpaceController::class, 'edit_bedspace'])->middleware('can:edit-bedspace');
Route::post('/bedspace/{id}/update', [BedSpaceController::class, 'update_bedspace'])->middleware('can:edit-bedspace');
Route::get('/bedspace/{id}/remove-resident', [BedSpaceController::class, 'remove_resident'])->middleware('can:edit-bedspace');
Route::post('/create_bedspace', [BedSpaceController::class, 'create_bedspace'])->middleware('can:create-bedspace');
Route::get('/delete_bed_space/{id}', [BedSpaceController::class, 'delete_bed_space'])->middleware('can:delete-bedspace');
Route::get('/get_room_details', [BedSpaceController::class, 'get_room_details'])->middleware('can:view-rooms');
Route::get('/room-amenities', [RoomController::class, 'roomAmenities'])->middleware('can:view-amenities');
Route::get('/room-locations', [RoomController::class, 'roomLocations'])->middleware('can:view-locations');
Route::get('/buildings', [RoomController::class, 'buildings'])->middleware('can:view-buildings');

//USER
Route::get('/users', [UserController::class, 'users'])->middleware('can:view-users');
Route::get('/administrators', [UserController::class, 'administrators'])->middleware('can:view-administrators');

//RENT
Route::get('/bookings', [RentController::class, 'bookings'])->middleware('can:view-bookings');
Route::get('/bookings/archived', [RentController::class, 'archived_rent'])->middleware('can:view-bookings');
Route::post('/bookings/{id}/approve_renewal', [RentController::class, 'approve_renewal'])->middleware('can:view-bookings');
Route::get('/bookings/{id}/decline_renewal', [RentController::class, 'decline_renewal'])->middleware('can:view-bookings');
Route::get('/bookings/renewal', [RentController::class, 'renewal'])->middleware('can:view-bookings');
Route::get('/bookings/progress', [RentController::class, 'progress_bar'])->middleware('can:view-bookings');
Route::post('/booking_status', [RentController::class, 'booking_status'])->middleware(['is.admin', 'can:view-bookings']);
Route::post('/update-document-status', [RentController::class, 'update_booking_status'])->middleware(['is.admin', 'can:view-bookings']);
Route::get('/booking_view/{id}', [RentController::class, 'view_bookings'])->middleware(['is.admin', 'can:view-bookings']);
Route::get('/booking_view/{id}/renewal', [RentController::class, 'view_bookings_renewal'])->middleware(['is.admin', 'can:view-bookings']);
Route::post('/school_info_status', [RentController::class, 'school_info_status'])->middleware(['is.admin', 'can:approve-rent']);
Route::get('/approve/{id}', [RentController::class, 'approve'])->middleware(['is.admin', 'can:approve-rent']);
Route::get('/reject/{id}', [RentController::class, 'reject'])->middleware(['is.admin', 'can:decline-rent']);
Route::post('/approve_rent', [RentController::class, 'approve_rent'])->middleware(['is.admin', 'can:approve-rent']);
Route::get('/archive/{rent_id}', [RentController::class, 'archive'])->middleware(['is.admin', 'can:approve-rent']);
Route::get('/decline_rent/{id}', [RentController::class, 'decline_rent'])->middleware(['is.admin', 'can:deline-rent']);

Route::get('/booking/{id}', [RentController::class, 'booking'])->middleware('is.verified');
Route::get('/booking/{id}/renew', [StudentController::class, 'booking_renew'])->middleware('is.verified');
Route::post('/renew_booking/{id}/', [StudentController::class, 'renew_booking'])->middleware('is.verified');
Route::get('/cancel-renewal/{id}/', [StudentController::class, 'cancel_renewal'])->middleware('is.verified');
Route::get('/book', [RentController::class, 'book']);
Route::post('/book_a_room', [RentController::class, 'book_room']);
Route::post('/booking_step', [RentController::class, 'booking_step']);

//Complains
Route::get('/complaints', [ComplainController::class, 'complains'])->middleware(['is.admin', 'can:view-complaints']);
Route::get('/complaint/{id}', [ComplainController::class, 'complain'])->middleware(['is.admin', 'can:view-complaints']);
Route::post('/complaint/{id}/update-items', [ComplainController::class, 'update_items'])->middleware(['is.admin', 'can:view-complaints']);
Route::get('/complaint/{id}/remove-all-items', [ComplainController::class, 'remove_all_items'])->middleware(['is.admin', 'can:view-complaints']);
Route::post('/task_completed', [ComplainController::class, 'task_completed'])->middleware(['is.admin', 'can:edit-task']);
Route::post('/assign', [ComplainController::class, 'assign'])->middleware(['is.admin', 'can:assign-task']);

//setttings & admin
Route::post('/update_ofbar', [AdminController::class, 'update_ofbar'])->middleware(['is.admin', 'can:edit-settings']);
Route::get('dashboard', [AdminController::class, 'index'])->middleware(['is.admin', 'can:view-dashboard']);
Route::get('/users-login-activities', [AdminController::class, 'users_login_activities'])->middleware(['is.admin', 'can:view-login-activities']);
Route::get('/invoices', [AdminController::class, 'invoices'])->middleware(['is.admin', 'can:view-invoices']);
Route::get('/resident/{user}/invoices', [AdminController::class, 'resident_invoices'])->middleware(['is.admin', 'can:view-invoices']);
Route::get('/direct-payments', [AdminController::class, 'direct_payments'])->middleware(['is.admin', 'can:view-payments']);
Route::get('/manual-payment', [AdminController::class, 'manual_payment'])->middleware(['is.admin', 'can:view-payments']);
Route::get('/create-payment/{application_no}', [AdminController::class, 'create_payment'])->middleware(['is.admin', 'can:create-payments']);
Route::get('/delete-payment/{application_no}', [AdminController::class, 'delete_payment'])->middleware(['is.admin', 'can:delete-payments']);
Route::post('/create-manual-payment', [AdminController::class, 'create_manual_payment'])->middleware(['is.admin', 'can:create-payments']);
Route::get('/delete_admin/{id}', [AdminController::class, 'delete_admin'])->middleware(['is.admin', 'can:delete-administrators']);
Route::post('/update_site_files', [AdminController::class, 'update_site_files'])->middleware(['is.admin', 'can:edit-site-files']);
Route::get('/settings', [AdminController::class, 'settings'])->middleware(['is.admin', 'can:view-settings']);
Route::get('/email-templates', [AdminController::class, 'emailTemplate'])->middleware(['is.admin', 'can:view-email-templates']);
Route::get('/financials', [AdminController::class, 'financials'])->middleware(['is.admin', 'can:view-financials']);
Route::get('/financial/{id}', [AdminController::class, 'billing_details'])->middleware(['is.admin', 'can:view-financials']);
Route::post('/checks', [AdminController::class, 'checks'])->middleware(['is.admin']);
Route::post('/choose_year', [AdminController::class, 'choose_year'])->middleware(['is.admin', 'can:change-viewing-year']);
Route::post('/update_settings', [AdminController::class, 'update_settings'])->middleware(['is.admin', 'can:edit-settings']);
Route::get('/disable-resident/{id}', [AdminController::class, 'disable_resident'])->middleware(['is.admin', 'can:disable-residents']);
Route::get('/enable-resident/{id}', [AdminController::class, 'enable_resident'])->middleware(['is.admin', 'can:enable-residents']);
Route::get('/disallow-change-profile-picture/{id}', [AdminController::class, 'disallow_change_profile_picture'])->middleware(['is.admin', 'can:edit-residents']);
Route::get('/allow-change-profile-picture/{id}', [AdminController::class, 'allow_change_profile_picture'])->middleware(['is.admin', 'can:edit-residents']);
Route::post('/update_site_settings', [AdminController::class, 'update_site_settings'])->middleware(['is.admin', 'can:edit-settings']);
Route::get('/disable-guest/{id}', [AdminController::class, 'disable_guest'])->middleware(['is.admin', 'can:edit-residents']);
Route::get('/enable-guest/{id}', [AdminController::class, 'enable_guest'])->middleware(['is.admin', 'can:edit-residents']);
Route::get('/update-max-guest-per-day/{id}', [AdminController::class, 'update_max_guest_per_day'])->middleware(['is.admin', 'can:edit-settings']);
Route::post('/update_email_template', [AdminController::class, 'update_email_template'])->middleware(['is.admin', 'can:edit-email-templates']);
Route::post('/update_email_recipients', [AdminController::class, 'update_email_recipients'])->middleware(['is.admin', 'can:edit-settings']);
Route::post('/year', [AdminController::class, 'years'])->middleware(['is.admin', 'can:create-academic-year']);
Route::post('/create_amenities', [AdminController::class, 'create_amenities'])->middleware(['is.admin', 'can:create-amenities']);
Route::post('/create_admin', [AdminController::class, 'create_admin'])->middleware(['is.admin', 'can:create-administrators']);
Route::post('/update_admin/{id}', [AdminController::class, 'update_admin'])->middleware(['is.admin', 'can:edit-administrators']);
Route::post('/message', [AdminController::class, 'message'])->middleware(['is.admin', 'can:view-task']);
Route::get('/notifications', [AdminController::class, 'notifications'])->middleware(['is.admin', 'can:view-notifications']);
Route::post('delete-user/{id}', [AdminController::class, 'deleteUser'])->middleware(['is.admin', 'can:delete-users']);
Route::post('update-user-password/{id}', [AdminController::class, 'updeteUserPassword'])->middleware(['is.admin', 'can:edit-residents']);

//products
Route::get('all-products/', [ProductController::class, 'index'])->middleware(['is.admin', 'can:view-products']);
Route::post('create_product/', [ProductController::class, 'store'])->middleware(['is.admin', 'can:create-products']);
Route::get('edit_product/{id}', [ProductController::class, 'edit'])->middleware(['is.admin', 'can:edit-products']);
Route::post('update_product/{id}', [ProductController::class, 'update'])->middleware(['is.admin', 'can:edit-products']);
Route::get('delete_product/{id}', [ProductController::class, 'destroy'])->middleware(['is.admin', 'can:delete-products']);

//Promo
Route::middleware(['auth'])->group(function () {
    Route::get('all-promo/', [PromoController::class, 'index'])->middleware(['is.admin', 'can:view-promo']);
    Route::get('new-promo/', [PromoController::class, 'select_type'])->middleware(['is.admin', 'can:create-promo']);
    Route::get('promo/referral ', [PromoController::class, 'referral'])->middleware(['is.admin', 'can:edit-promo']);
    Route::get('new-promo/regular', [PromoController::class, 'regular'])->middleware(['is.admin', 'can:create-promo']);
    Route::get('new-promo/special', [PromoController::class, 'special'])->middleware(['is.admin', 'can:create-promo']);
    Route::post('create-promo/', [PromoController::class, 'store'])->middleware(['is.admin', 'can:create-promo']);
    Route::post('/promo/change_active_status', [PromoController::class, 'change_active_status'])->middleware(['is.admin', 'can:edit-promo']);

    Route::get('edit-promo/{promo_code}', [PromoController::class, 'edit'])->middleware(['is.admin', 'can:edit-promo']);
    Route::post('update-promo', [PromoController::class, 'update'])->middleware(['is.admin', 'can:edit-promo']);
    Route::post('promo/update-referral', [PromoController::class, 'update_referral_settings'])->middleware(['is.admin', 'can:edit-promo']);
    Route::get('promo/referrer/{user_id}', [PromoController::class, 'referrer'])->middleware(['is.admin', 'can:edit-promo', 'can:view-promo', 'can:view-referrers']);
    Route::post('promo/make-referral-payment', [PromoController::class, 'make_referral_payment'])->middleware(['is.admin', 'can:edit-promo']);
    Route::get('referrals', [PromoController::class, 'referrer_dashboard'])->middleware(['is.verified'])->withoutMiddleware(['is.admin']);
    Route::get('generate-referral-code', [PromoController::class, 'generate_referral_code'])->middleware(['is.verified'])->withoutMiddleware(['is.admin']);
    Route::get('check-promo-code', [PromoController::class, 'check_promo_code'])->withoutMiddleware(['is.admin']);
});

//Promo
Route::middleware(['auth', 'is.admin'])->prefix('inventories')->group(function () {
    Route::get('/item-exist/', [\App\Http\Controllers\InventoryController::class, 'item_exist'])->middleware(['can:view-inventory']);
    Route::get('/categories', [\App\Http\Controllers\InventoryController::class, 'categories'])->middleware(['can:view-inventory']);

    Route::post('/category/store', [\App\Http\Controllers\InventoryController::class, 'store_category'])->middleware(['can:create-inventory']);
    Route::post('/category/{category}/update', [\App\Http\Controllers\InventoryController::class, 'update_category'])->middleware(['can:create-inventory']);
    Route::get('/category/{category}/delete', [\App\Http\Controllers\InventoryController::class, 'destroy_category'])->middleware(['can:create-inventory']);
    Route::get('/', [\App\Http\Controllers\InventoryController::class, 'index'])->middleware(['can:view-inventory']);
    Route::get('/create', [\App\Http\Controllers\InventoryController::class, 'create'])->middleware(['can:create-inventory']);
    Route::get('/purchased', [\App\Http\Controllers\InventoryController::class, 'purchased'])->middleware(['can:view-inventory']);
    Route::get('/{inventory}', [\App\Http\Controllers\InventoryController::class, 'show'])->middleware(['can:view-inventory']);

    Route::post('/store', [\App\Http\Controllers\InventoryController::class, 'store'])->middleware(['can:create-inventory']);
    Route::post('/update/{inventory}', [\App\Http\Controllers\InventoryController::class, 'update'])->middleware(['can:update-inventory']);
    Route::get('/delete/{inventory}', [\App\Http\Controllers\InventoryController::class, 'destroy'])->middleware(['can:delete-inventory']);
    Route::get('/get-items-by-category/{id}', [\App\Http\Controllers\InventoryController::class, 'get_items_by_category'])->middleware(['can:view-inventory']);

    Route::get('/get-items-details-by-name/{name}', [\App\Http\Controllers\InventoryController::class, 'get_items_details_by_name'])->middleware(['can:view-inventory']);
});

//Route for Biometrics
// Route::get('webauthn/register/options', [WebAuthnRegisterController::class, 'options'])->name('webauthn.register.options');
// Route::get('webauthn/register', [WebAuthnRegisterController::class, 'register'])->name('webauthn.register');

// Route::get('webauthn/login/options', [WebAuthnLoginController::class, 'options'])->name('webauthn.login.options');
// Route::get('webauthn/login', [WebAuthnLoginController::class, 'login'])->name('webauthn.login');

// Route::get('webauthn/confirm', 'Auth\WebAuthnConfirmController@showConfirmForm')->name('webauthn.confirm.form');
// Route::post('webauthn/confirm/options', 'Auth\WebAuthnConfirmController@options')->name('webauthn.confirm.options');
// Route::post('webauthn/confirm', 'Auth\WebAuthnConfirmController@confirm')->name('webauthn.confirm');




Route::get('fill-data-pdf/{document}/user/{user}', [PDFController::class, 'index']);


Route::get('this/is/important', function () {
    return 'This is very important!';
})->middleware('webauthn.confirm');


Route::get('/logout', function (Request $request) {

    Auth::logout();
    if ($request->error == 'account_deactivated') {
        return redirect('/login')->with('error', 'Your Acoount has been disabled by administrator');
    } else {
        return redirect('/login');
    }
});
