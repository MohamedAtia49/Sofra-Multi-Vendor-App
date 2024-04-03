<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $record = Setting::find(1);
        return view('admin.settings.edit',compact('record'));
    }
    public function edit(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'about_app' => 'required',
            'app_commissions_text' => 'required',
        ]);
        $record = Setting::find($id);
        $record->update($request->all());
        return redirect()->back();
    }

}
