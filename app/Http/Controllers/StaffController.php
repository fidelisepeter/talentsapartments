<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use function App\View\Components\send_mail;
use function App\View\Components\createNotification;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();
        return view('pages.staff.index')->with('staffs', $staffs);
    }

    public function profile() {
        
        return view('pages.staff.profile');
    }

    public function settings() {
        
        return view('pages.staff.settings');
    }

    /**
     * Show the form for creating a new staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




        $supervisors = User::where('role', '!=', 'student')->get();
        $roles = Role::all();
        $departments = Department::all();
        return view('pages.staff.create')->with([
            'supervisors' =>  $supervisors,
            'roles' =>  $roles,
            'departments' =>  $departments,
        ]);
    }

    /**
     * Store a newly created staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
            'role' => 'staff',
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'year' => DB::table('settings')->value('current_year'),
        ]);

        $user->staff()->create([
            'supervisor_id' => $request->supervisor,
            'department' => $request->department,
            'position' => $request->position,
            'salary' => $request->salary,
            'year' => DB::table('settings')->value('current_year'),
            'start_date' => $request->start_date,
        ]);

        if ($request->role) {
            $user->assignRole($request->role);
        }


        $supervisor = User::where('id', $request->supervisor)->first();
        $input = ['[first_name]', '[last_name]', '[email]', '[password]', '[role]', '[supervisor_first_name]', '[supervisor_middle_name]', '[supervisor_last_name]', '[supervisor_email]', '[supervisor_phone_number]', '[position]', '[salary]', '[department]', '[note]'];
        $outfilled = [$user->first_name, $user->last_name, $user->email, $request->password, $request->role, $supervisor->first_name, $supervisor->middle_name, $supervisor->last_name, $supervisor->email, $supervisor->phone_number, $request->position, $request->salary, $request->department, $request->department];
        $message =  str_replace($input, $outfilled,  DB::table('settings')->value('new_staff_created_email'));

        send_mail($user->first_name . ' ' . $user->last_name, $user->email, 'New Staff Details', $message);

        return redirect('/staff/' . $user->id . '/permissions')->with('success', 'Staff created successfully');

        // dd($user);
    }

    /**
     * Display the specified staff.
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


        $roles = Role::all();
        $permissions = Permission::all();

        $viewingYear = DB::table('settings')->value('viewing_year');
        $last_login = DB::table('login_details')->where('year', $viewingYear)->where('user_id', $user->id)->orderBy('login_date', 'desc')->value('login_date');

        $permissions = Permission::all();
        return view('pages.staff.view')->with([
            'staff' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_roles' => $user->roles,
            'user_roles_permissions' => array_unique($permission),
            'last_login' => $last_login
        ]);
    }

    /**
     * Show the form for editing the specified staff.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function edit(User $user)
    {
        $permission = [];
        foreach ($user->roles as $user_roles) {
            $role = Role::findByName($user_roles->name);
            foreach ($role->permissions as $role_permission) {
                $permission[] = $role_permission->name;
            }
        }


        $roles = Role::all();
        $permissions = Permission::all();

        $viewingYear = DB::table('settings')->value('viewing_year');
        $last_login = DB::table('login_details')->where('year', $viewingYear)->where('user_id', $user->id)->orderBy('login_date', 'desc')->value('login_date');

        $permissions = Permission::all();
        return view('pages.staff.edit')->with([
            'staff' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_roles' => $user->roles,
            'user_roles_permissions' => array_unique($permission),
            'last_login' => $last_login
        ]);
    }
    
    public function match(Request $request)
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
     * Update the specified staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function update_supervisor(Request $request, User $user)
    {
        //    dd($request->all());

        $user->staff->update([
            'supervisor_id' => $request->supervisor,
        ]);
        // dd($user->staff);
        return redirect()->back()->with('success', 'Staff updated successfully');
    }

    public function update_department(Request $request, User $user)
    {
        //    dd($request->all());

        $user->staff->update([
            'department' => $request->department,
        ]);
        // dd($user->staff);
        return redirect()->back()->with('success', 'Staff updated successfully');
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

        $date = [
            'start' => $start_date,
            'end' => $end_date,
        ];
        // $login_reports = $user->logins;
        // dd($login);

        return view('pages.staff.logins')->with([
            'staff' => $user,
            'logins' => $login,
            'date' => [
                'start' => $start_date,
                'end' => $end_date,
            ],
        ]);
    }

    /**
     * Update the specified staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->staff->update([
            'salary' => $request->salary,
            'position' => $request->position,
        ]);
        // dd($user->staff);
        return redirect()->back()->with('success', 'Staff updated successfully');
    }
    
      public function update_password(Request $request, User $user)
    {

       // dd($request->all());
        // $user = User::where('id', Auth::id())->first();

        // if (!(Hash::check($request->current_password, Auth::user()->password))) {
        //     // The passwords matches
        //     return redirect()->back()->with("error", "Your current password does not matches with the password.");
        // }

        // if (strcmp($request->current_password, $request->new_password) == 0) {
        //     // Current password and new password same
        //     return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        // }

        if (strcmp($request->confirm_new_password, $request->new_password) != 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "Comfirm password does not match.");
        }

        // $validatedData = $request->validate([
        //     'current_password' => 'required',
        //     'new_password' => 'required|string|min:8|confirmed',
        // ]);

        //Change Password
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        return redirect()->back()->with('success', 'Password updated successfully');
    }
    
    public function update_details(Request $request, User $user)
    {

      // dd($request->all());


        // $user = User::where('id', Auth::id())->first();

        if ($user->role == 'lawyer') {
            $stamp = $user->lawyer->stamp;
            $signature = $user->lawyer->signature;
        }

        $photo = $user->photo;


        if ($request->stamp || $request->signature || $request->photo) {
            //  dd($request->all());

            request()->validate([
                'stamp' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'signature' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);



            if ($request->signature) {
                $signature_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-signature' . $request->signature->getClientOriginalName());
                $request->signature->storeAs('document-files', $signature_file, 'public_uploads');

                $signature = 'document-files/' . $signature_file;
                $user->lawyer->update([
                    'signature' => $signature,
                ]);
            }




            if ($request->stamp) {

                $stamp_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-stamp' . $request->stamp->getClientOriginalName());
                $request->stamp->storeAs('document-files', $stamp_file, 'public_uploads');


                $stamp = 'document-files/' . $stamp_file;

                $user->lawyer->update([
                    'stamp' => $stamp,
                ]);
            }

            if ($request->photo) {
                $photo_file = str_replace(' ', '-', $user->first_name . '- ' . $user->last_name . '-photo' . $request->photo->getClientOriginalName());
                $request->photo->storeAs('document-files', $photo_file, 'public_uploads');

                $photo = url('document-files/' . $photo_file);
            }
        }




        // dd($photo);
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'photo' => $photo,
            'phone_number' => $request->phone_number ?? $user->phone_number,
            'street' => $request->address ?? $user->street,
            'city' => $request->city ?? $user->city,
            'state' => $request->state ?? $user->state,
            'company' => $request->company ?? $user->company,
            'inscription' => $request->inscription ?? $user->inscription,
            'office_phone' => $request->office_phone ?? $user->office_phone,
            'note' => $request->note ?? $user->note,
            'note_1' => $request->note_1 ?? $user->note_1,

        ]);


        return redirect()->back()->with("success", "Staff successfully updated!");
    }

    /**
     * Show the form for editing the specified staff.
     *
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function permissions(User $user)
    {

        // $role = Role::findByName('Admin');

        // $role->givePermissionTo('view-staff');
        $permission = [];

        foreach ($user->roles as $user_roles) {
            $role = Role::findByName($user_roles->name);
            foreach ($role->permissions as $role_permission) {
                $permission[] = $role_permission->name;
            }
        }

        // dd(array_unique($permission));
        // $user->revokePermissionTo('delete-staff');
        $roles = Role::all();
        $permissions = Permission::all();
        return view('pages.staff.permission')->with([
            'staff' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_roles' => $user->roles,
            'user_roles_permissions' => array_unique($permission),
        ]);
    }

    /**
     * Update the specified staff permissionin storage.
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
     * Update the specified staff role in storage.
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

        return redirect()->back()->with('success', 'Staff Role Updated');
    }

    /**
     * Remove the specified staff from storage.
     *
     * @param  obj  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd($user);
        $user->delete();
        return redirect('/staff')->with('success', 'Staff Deleted');
    }
}
