<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {
    public function all($model)
    {
        try{
            $records = $model::all();
            return view('admin.categories.index',compact('records'));
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
            return redirect()->route('categories.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($model,$id){
        try {
            $record = $model::find($id);
            return view('admin.categories.edit',compact('record'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function update($model, $id, array $request){
        try {
            $model::find($id)->update($request);
            return redirect()->route('categories.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($model, $id){
        $model::find($id)->delete();
        return redirect()->back();
    }

}

