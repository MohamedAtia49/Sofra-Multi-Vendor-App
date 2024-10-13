<?php

namespace App\Services\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;

class OrderService{
    public function index(Request $request)
    {
        $records = Order::with('meals','client','restaurant')
                        ->where('name','like',"%$request->search%")
                        ->orWhere('phone','like',"%$request->search%")
                        ->paginate(4);
        return view('admin.orders.index',compact('records'));
    }

    public function generatePDF()
    {
        $records = Order::all();
        try{
            $pdf = Pdf::loadView('admin.orders.print',compact('records'));
            return $pdf->inline();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
