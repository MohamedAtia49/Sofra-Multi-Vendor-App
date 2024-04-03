<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $records = City::all();
        return view('admin.cities.index',compact('records'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name',
        ]);
        City::create($request->all());
        return redirect()->route('cities.index');
    }

    public function edit($id)
    {
        $record = City::find($id);
        return view('admin.cities.edit',compact('record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:cities,name',
        ]);
        $record = City::find($id);
        $record->update($request->all());
        return redirect()->route('cities.index');
    }

    public function destroy($id)
    {
        $record = City::find($id);
        $record->delete();
        return redirect()->back();
    }
}
