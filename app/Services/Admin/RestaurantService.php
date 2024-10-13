<?php

namespace App\Services\Admin;

use App\Models\Restaurant;

class RestaurantService{
    public function index()
    {
        $records = Restaurant::with('region')->paginate(4);
        return view('admin.restaurants.index',compact('records'));
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
