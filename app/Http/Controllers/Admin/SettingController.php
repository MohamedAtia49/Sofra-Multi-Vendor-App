<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
        public function index(){
        $records = Setting::all();
        return view('admin.settings.index',compact('records'));
    }
    public function create()
    {
        // $records = Setting::all();
        $types = ['text','number','file'];
        return view('admin.settings.create',compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);
        Setting::create($request->all());
        return redirect()->back()->with('message','Setting Created Successfully!!');
    }

    public function edit($id){
        $record = Setting::find($id);
        $types = ['text','number','file'];
        $setting_type = $record->type ;
        // dd($setting_type);
        return view('admin.settings.edit',compact('record','types','setting_type'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);
        $record = Setting::find($id);
        $record->update([
            'key' => $request->key,
            'value' => $request->key,
            'type' => $request->type,
        ]);
        return redirect()->back()->with('message','Setting Updated Successfully!!');
    }

    public function destroy($id){
        $record = Setting::find($id);
        $record->delete();
        return redirect()->back();
    }
}
