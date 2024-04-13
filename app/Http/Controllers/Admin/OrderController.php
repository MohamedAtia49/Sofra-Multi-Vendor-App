<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $records = Order::with('meals','client','restaurant')->where('name','like',"%$request->search%")->orWhere('phone','like',"%$request->search%")->get();
        return view('admin.orders.index',compact('records'));
    }

    public function generatePDF()
    {
        $records = Order::all();
        $pdf = Pdf::loadView('admin.orders.print',compact('records'));
        return $pdf->inline();
    }
}
