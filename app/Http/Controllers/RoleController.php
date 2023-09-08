<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('pages.role.index')->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function permissions(Request $request, Role $role)
    {
        $givePermissionTo = [];
        $revokePermissionTo = [];


        foreach ($role->permissions as $role_permission) {
            $revokePermissionTo[] = $role_permission->name;
        }



        $givePermissionTo = array_keys($request->except('_token'));

        if ($revokePermissionTo) {
            $role->revokePermissionTo($revokePermissionTo);
        }

        if ($givePermissionTo) {
            $role->givePermissionTo($givePermissionTo);
        }
        // $role->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        // ]);

        return redirect()->back()->with('success', 'Role updated successfully');
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

        $role = Role::create(['name' => $request->name]);

        return redirect('/role/' . str_replace(' ', '-', strtolower($role->name)));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $role
     * @return \Illuminate\Http\Response
     */
    public function show($role)
    {
        // dd(Role::findByName(str_replace('-', ' ', $role)));

        $role = Role::findByName(str_replace('-', ' ', $role));
        $permissions = Permission::all();

    
        return view('pages.role.view')->with([
            'role' => $role,
            'permissions' => $permissions,
            
        ]);
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
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);
        return redirect('role/' . str_replace(' ', '-', strtolower($role->name)))->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  obj  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        // dd($role);
        $role->delete();
        return redirect('/role')->with('success', 'Role has been deleted');
    }
}
