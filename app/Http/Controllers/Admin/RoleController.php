<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $records = Role::with('permissions')->get();
        return view('admin.roles.index',compact('records'));
    }

    public function create()
    {
        $records = Permission::all();
        return view('admin.roles.create',compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $record = Role::create($request->all());
        $record->givePermissionTo($request->permissions,[]);
        return redirect('/admin/roles')->with('message','Role Created Successfully!!');
    }

    public function edit(string $id)
    {
        $record = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('record','permissions'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $record = tap(Role::find($id))->update($request->all());
        $record->syncPermissions($request->permissions,[]);

        return redirect('/admin/roles')->with('message','Role Updated !');
    }

    public function destroy(string $id)
    {
        $record = Role::find($id);
        $record->delete();

        return redirect()->back()->with('deleted_message','Role Deleted !');
    }
}
