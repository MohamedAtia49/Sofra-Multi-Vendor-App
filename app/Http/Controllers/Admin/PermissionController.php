<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $records = Permission::all();
        return view('admin.permission.index',compact('records'));
    }


    public function create()
    {
        return view('admin.permission.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        Permission::create($request->all());
        return redirect('/admin/permissions')->with('message','Permission Created Successfully !!');
    }

    public function edit(string $id)
    {
        $record = Permission::find($id);
        return view('admin.permission.edit',compact('record'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        $record = Permission::find($id);
        $record->update($request->all());
        return redirect('/admin/permissions')->with('message','Permission Updated Successfully !!');
    }


    public function destroy(string $id)
    {
        $record = Permission::find($id);
        $record->delete();
        return redirect()->back()->with('deleted_message','Permission Deleted Successfully !!');
    }
}
