<?php
namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use Spatie\Permission\Models\Role;

class AdminRepository implements AdminRepositoryInterface {
    public function all($model)
    {
        try{
            $records = $model::with('roles')->get();
            return view('admin.admins.index',compact('records'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function create($nameView){
        $records = Role::all();
        return view($nameView,compact('records'));
    }
    public function store($model , array $request){
        try {
            $record = $model::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            $roles = $record->assignRole($request['roles'],[]);
            $roles = $record->roles;
            foreach ($roles as $role){
                $permissions = $role->permissions;
                $record->givePermissionTo($permissions);
            }
            return redirect()->route('admins.index')->with('message','Admin Created Successfully!!');;
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($model,$id){
        try {
            $record = $model::find($id);
            $roles = Role::all();
            return view('admin.admins.edit',compact('record','roles'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function update($model, $id, array $request){
        try {
            $record = $model::find($id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            $roles = $record->syncRoles($request['roles'],[]);
            $roles = $record->roles;
            foreach ($roles as $role){
                $permissions[] = $role->permissions;
            }
            $record->syncPermissions($permissions);
            return redirect()->route('admins.index')->with('message','Admin Updated Successfully!!');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($model, $id){
        $record = $model::find($id);
        if($record->id == 1){
            return redirect()->back()->with('cant_delete_super_admin','Sorry Super Admin Cant be Deleted!');
        }else{
            $record->delete();
            return redirect()->back()->with('deleted_message','User Deleted Successfully!!');
        }
    }

}

