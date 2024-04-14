<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {
        $records = User::with('roles')->get();
        return view('admin.admins.index',compact('records'));
    }



    public function create()
    {
        $records = Role::all();
        return view('admin.admins.create',compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:8,255|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
        $record = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $roles = $record->assignRole($request->roles,[]);

        $roles = $record->roles;
        foreach ($roles as $role){
            $permissions = $role->permissions;
            $record->givePermissionTo($permissions);
        }

        return redirect('/admin/admins')->with('message','Admin Created Successfully!!');
    }

    public function edit(string $id)
    {
        $record = User::find($id);
        $roles = Role::all();
        return view('admin.admins.edit',compact('record','roles'));
    }

    public function update(Request $request, string $id)
    {
        $record = User::find($id);
        $record->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $roles = $record->syncRoles($request->roles,[]);

        $roles = $record->roles;
        foreach ($roles as $role){
            $permissions[] = $role->permissions;
        }
        $record->syncPermissions($permissions);

        return redirect('/admin/admins')->with('message','Admin Updated Successfully!!');

    }

    public function destroy(string $id)
    {
        $record = User::find($id);
        if($record->id == 1){
            return redirect()->back()->with('cant_delete_super_admin','Sorry Super Admin Cant be Deleted!');
        }else{
            $record->delete();
            return redirect()->back()->with('deleted_message','User Deleted Successfully!!');
        }
    }
}
