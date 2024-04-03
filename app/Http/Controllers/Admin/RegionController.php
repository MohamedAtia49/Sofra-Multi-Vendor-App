<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function index()
    {
        $records = Region::with('city')->get();
        return view('admin.regions.index',compact('records'));
    }


    public function create()
    {
        $cities = City::all();
        return view('admin.regions.create',compact('cities'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:regions,name',
            'city_id' => 'required|exists:cities,id',
        ]);
        Region::create($request->all());
        return redirect()->route('regions.index');
    }

    public function edit($id)
    {
        $record = Region::with('city')->find($id);
        $cities = City::all();
        return view('admin.regions.edit',compact('record','cities'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:regions,name',
            'city_id' => 'required|exists:cities,id',
        ]);
        $record = Region::find($id);
        $record->update($request->all());
        return redirect()->route('regions.index');
    }


    public function destroy($id)
    {
        //
    }
}
