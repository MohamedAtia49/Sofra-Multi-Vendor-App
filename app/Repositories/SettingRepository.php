<?php
namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface {
    public function all($model)
    {
        try{
            $records = $model::all();
            return view('admin.settings.index',compact('records'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function create($nameView){
        try{
            $types = ['text','number','file'];
            return view($nameView,compact('types'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function store($model , array $request){
        try {
            $model::create($request);
            return redirect()->route('settings.index')->with('message','Setting Created Successfully!!');;
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($model,$id){
        try {
            $record = $model::find($id);
            $types = ['text','number','file'];
            $setting_type = $record->type ;
            return view('admin.settings.edit',compact('record','types','setting_type'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function update($model, $id, array $request){
        try {
            $model::find($id)->update([
                'key' => $request['key'],
                'value' => $request['value'],
                'type' => $request['type'],
            ]);
            return redirect()->route('settings.index')->with('message','Setting Updated Successfully!!');;
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($model, $id){
        $model::find($id)->delete();
        return redirect()->back();
    }

}

