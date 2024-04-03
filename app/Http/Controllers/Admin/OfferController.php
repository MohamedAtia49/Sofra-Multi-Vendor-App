<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index(Request $request)
    {
        $records = Offer::with('restaurant')
                    ->whereHas('restaurant',function($query) use($request){
                        $query->where('name','like',"%$request->search%");
                    })->orWhere('meal_name','like',"%$request->search%")
                    ->get();
        return view('admin.offers.index',compact('records'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
