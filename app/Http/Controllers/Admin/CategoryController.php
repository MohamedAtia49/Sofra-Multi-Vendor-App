<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $records = Category::all();
        return view('admin.categories.index',compact('records'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $record = Category::find($id);
        return view('admin.categories.edit',compact('record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $record = Category::find($id);
        $record->update($request->all());
        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        $record = Category::find($id);
        $record->delete();
        return redirect()->back();

    }
}
