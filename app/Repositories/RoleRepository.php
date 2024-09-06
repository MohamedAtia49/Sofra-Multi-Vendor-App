<?php
namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface {
    public function all($model)
    {
        try{
            $records = $model::with('permissions')->get();
            return view('admin.roles.index',compact('records'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function create($nameView){
        $records = Permission::all();
        return view($nameView,compact('records'));
    }
    public function store($model , array $request){
        try {
            $record = $model::create($request);
            $record->givePermissionTo($request['permissions'],[]);
            return redirect()->route('roles.index')->with('message','Role Created Successfully!!');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($model,$id){
        try {
            $record = $model::with('permissions')->find($id);
            $permissions = Permission::all();
            return view('admin.roles.edit',compact('record','permissions'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function update($model, $id, array $request){
        try {
            $record = tap($model::find($id))->update($request);
            $record->syncPermissions($request['permissions'],[]);
            return redirect()->route('roles.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($model, $id){
        $model::find($id)->delete();
        return redirect()->back()->with('deleted_message','Role Deleted !');

    }

}

