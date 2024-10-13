<?php

namespace App\Services\Admin;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientService{
    public function index(Request $request)
    {
        $records = Client::with('region')->where('name','like',"%$request->search%")
                        ->orWhere('email','like',"%$request->search%")
                        ->orWhere('phone','like',"%$request->search%")
                        ->paginate(1);
        return view('admin.clients.index',compact('records'));
    }
    public function destroy($id)
    {
        $record = Client::find($id);
        $record->orders()->delete();
        $record->reviews()->delete();
        $record->delete();
        return redirect()->back();
    }

    public function active($id)
    {
        $restaurant = Client::find($id);
        $restaurant->update([
            'is_active' => 1,
        ]);

        return redirect()->back();
    }

    public function deActive($id)
    {
        $restaurant = Client::find($id);
        $restaurant->update([
            'is_active' => 0,
        ]);

        return redirect()->back();
    }
}
