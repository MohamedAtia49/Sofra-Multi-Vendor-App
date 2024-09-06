<?php
namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface {
    public function all($model)
    {
        try{
            $records = $model::all();
            return view('admin.cities.index',compact('records'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function create($nameView){
        return view($nameView);
    }
    public function store($model , array $request){
        try {
            $model::create($request);
            return redirect()->route('cities.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($model,$id){
        try {
            $record = $model::find($id);
            return view('admin.cities.edit',compact('record'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function update($model, $id, array $request){
        try {
            $model::find($id)->update($request);
            return redirect()->route('cities.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($model, $id){
        $model::find($id)->delete();
        return redirect()->back();
    }

}

