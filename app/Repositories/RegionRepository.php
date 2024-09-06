<?php

namespace App\Repositories;
use App\Interfaces\RegionRepositoryInterface;
use App\Models\City;

class RegionRepository implements RegionRepositoryInterface{
    public function all($model)
    {
        try{
            $records = $model::all();
            return view('admin.regions.index',compact('records'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function create($nameView)
    {
        try{
            $cities = City::all();
            return view($nameView,compact('cities'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function store($model, array $request)
    {
        try{
            $records = City::all();
            $model::create($request);
            return redirect()->route('regions.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function edit($model, $id)
    {
        try{
            $record = $model::with('city')->find($id);
            $cities = City::all();
            return view('admin.regions.edit',compact('record','cities'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function update($model, $id , array $request)
    {
        try{
            $record = $model::find($id)->update($request);
            return redirect()->route('regions.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function destroy($model, $id)
    {
        try{
            $record = $model::find($id);
            $record->delete();
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

}
