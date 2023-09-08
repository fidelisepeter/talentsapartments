<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lawyer;
use App\Models\Department;
use App\Models\SignedDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use function App\View\Components\send_mail;
use function App\View\Components\createNotification;


class LawyerController extends Controller
{
   /**
     * Display a listing of the lawyer.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile() {
        
        return view('pages.lawyer.profile');
    }

    public function settings() {
        
        return view('pages.lawyer.settings');
    }

    public function new_document_email_notification(Request $request) {
        // dd($request->all());

        Auth::user()->lawyer->update([
            'new_document_email_notification' => $request->new_document_email_notification == 'on' ? true : false,
        ]);
        
        return redirect()->back()->with("success", "Settings successfully changed!");
    }

    public function index()
    {
        $lawyers = Lawyer::all();
        return view('pages.lawyer.index')->with('lawyers', $lawyers);
    }

    /**
     * Show the form for creating a new lawyer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $supervisors = User::where('role', '!=', 'student')->get();
        $roles = Role::all();
        $departments = Department::all();
        return view('pages.lawyer.create')->with([
            'supervisors' =>  $supervisors,
            'roles' =>  $roles,
            'departments' =>  $departments,
        ]);
    }

    /**
     * Store a newly created lawyer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->street);
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'digits:11', 'unique:users'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'lawyer',
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'year' => DB::table('settings')->value('current_year'),
        ]);

        // dd($user);

        $user->lawyer()->create([
            'salary' => $request->salary,
            'year' => DB::table('settings')->value('current_year'),
            'start_date' => $request->start_date,
        ]);

        $user->assignRole('Lawyer');


        // $supervisor = User::where('id', $request->supervisor)->first();
        $input = ['[first_name]', '[last_name]', '[email]', '[password]', '[role]', '[salary]', '[note]'];
        $outfilled = [$user->first_name, $user->last_name, $user->email, $request->password, 'Laywer', $request->salary, $request->note];
        $message =  str_replace($input, $outfilled,  DB::table('settings')->value('new_staff_created_email'));

        send_mail($user->first_name . ' ' . $user->last_name, $user->email, 'New Lawyer Details', $message);

        return redirect('/lawyer/' . $user->id . '/permissions')->with('success', 'Lawyer created successfully');

        // dd($user);
    }

    /**
     * Display the specified lawyer.
     *
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $permission = [];
        foreach ($user->roles as $user_roles) {
            $role = Role::findByName($user_roles->name);
            foreach ($role->permissions as $role_permission) {
                $permission[] = $role_permission->name;
            }
        }


        // $report
        $roles = Role::all();
        $permissions = Permission::all();

        $viewingYear = DB::table('settings')->value('viewing_year');
        $last_login = DB::table('login_details')->where('year', $viewingYear)->where('user_id', $user->id)->orderBy('login_date', 'desc')->value('login_date');

        $reports = SignedDocuments::where('lawyer_id' , $user->id)->get();
        $permissions = Permission::all();
        return view('pages.lawyer.view')->with([
            'lawyer' => $user,
            'reports' => $reports,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_roles' => $user->roles,
            'user_roles_permissions' => array_unique($permission),
            'last_login' => $last_login
        ]);
    }

    /**
     * Show the form for editing the specified reports.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $column = $request->column ?? 'column';
        $value = $request->value ?? 'value';
        $user = User::where($column, $value)->first();

        // return json_encode([
        //     'data' => null,
        //     'message' => 'no_user_exist',
        // ]);

        if ($user) {
            return json_encode([
                'data' => $user,
                'message' => 'user_exist',
            ]);
        } else {
            return json_encode([
                'data' => null,
                'message' => 'no_user_exist',
            ]);
        }
    }

    /**
     * Update the specified lawyer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function update_supervisor(Request $request, User $user)
    {
        //    dd($request->all());

        $user->lawyer->update([
            'supervisor_id' => $request->supervisor,
        ]);
        // dd($user->lawyer);
        return redirect()->back()->with('success', 'Lawyer updated successfully');
    }

    public function update_department(Request $request, User $user)
    {
        //    dd($request->all());

        $user->lawyer->update([
            'department' => $request->department,
        ]);
        // dd($user->lawyer);
        return redirect()->back()->with('success', 'Lawyer updated successfully');
    }

    public function login_reports(Request $request, User $user)
    {

        $filter = $request->daterange;

        if ($request->start || $request->end) {
            $start_date = $request->start;
            $end_date = $request->end;
        } else {
            $start_date = $user->created_at;
            $end_date = date('Y-m-d');
        }

        $viewingYear = DB::table('settings')->value('viewing_year');
        $login = DB::table('login_details')->whereBetween(DB::raw('DATE(login_date)'), array($start_date, $end_date))->where('year', $viewingYear)->where('user_id', $user->id)->orderBy('login_date', 'desc')->get();

        // dd($login);s
        $date = [
            'start' => $start_date,
            'end' => $end_date,
        ];
        // $login_reports = $user->logins;
        // dd($login);

        return view('pages.lawyer.logins')->with([
            'lawyer' => $user,
            'logins' => $login,
            'date' => [
                'start' => $start_date,
                'end' => $end_date,
            ],
        ]);
    }

    /**
     * Update the specified lawyer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->lawyer->update([
            'salary' => $request->salary,
            'position' => $request->position,
        ]);
        // dd($user->lawyer);
        return redirect()->back()->with('success', 'Lawyer updated successfully');
    }

    /**
     * Show the form for editing the specified lawyer.
     *
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function permissions(User $user)
    {

        // $role = Role::findByName('Admin');

        // $role->givePermissionTo('view-lawyer');
        // dd($user->roles->first()->name);
        $permission = [];

        // $user->assignRole('Lawyer');
        // dd()
        foreach ($user->roles as $user_roles) {
            $role = Role::findByName($user_roles->name);
            foreach ($role->permissions as $role_permission) {
                $permission[] = $role_permission->name;
            }
        }

        // dd(array_unique($permission));
        // $user->revokePermissionTo('delete-lawyer');
        $roles = Role::all();

        $permissions = Permission::all();
        // dd($user);
        return view('pages.lawyer.permission')->with([
            'lawyer' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_roles' => $user->roles,
            'user_roles_permissions' => array_unique($permission),
        ]);
    }

    /**
     * Update the specified lawyer permissionin storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $id
     * @return \Illuminate\Http\Response
     */
    public function update_permission(Request $request, User $user)
    {

        $givePermissionTo = [];
        $revokePermissionTo = [];


        foreach ($user->permissions as $user_permission) {
            $revokePermissionTo[] = $user_permission->name;
        }



        $givePermissionTo = array_keys($request->except('_token'));

        if ($revokePermissionTo) {
            $user->revokePermissionTo($revokePermissionTo);
        }

        if ($givePermissionTo) {
            $user->givePermissionTo($givePermissionTo);
        }

        return redirect()->back()->with('success', 'User Permissions Updated');
    }

    /**
     * Update the specified lawyer role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $id
     * @return \Illuminate\Http\Response
     */
    public function update_role(Request $request, User $user)
    {
        foreach ($user->roles as $user_roles) {

            $user->removeRole($user_roles->name);
        }

        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Lawyer Role Updated');
    }

    /**
     * Remove the specified lawyer from storage.
     *
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd($user);
        $user->delete();
        return redirect('/lawyer')->with('success', 'Lawyer Deleted');
    }
}
