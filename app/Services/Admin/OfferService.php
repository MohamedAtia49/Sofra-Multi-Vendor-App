<?php

namespace App\Services\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferService{
    public function index(Request $request)
    {
        $records = Offer::with('restaurant')
                    ->whereHas('restaurant',function($query) use($request){
                        $query->where('name','like',"%$request->search%");
                    })->orWhere('meal_name','like',"%$request->search%")
                    ->paginate(4);
        return view('admin.offers.index',compact('records'));
    }
}
