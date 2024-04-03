<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function index()
    {
        $records = Restaurant::with('region')->get();
        return view('admin.restaurants.index',compact('records'));
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $record = Restaurant::find($id);
        $record->meals()->delete();
        $record->offers()->delete();
        $record->delete();
        return redirect()->back();
    }

    public function active($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->update([
            'is_active' => 1,
        ]);

        return redirect()->back();
    }
    public function deActive($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->update([
            'is_active' => 0,
        ]);

        return redirect()->back();
    }
}
