<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;

class OrderController extends Controller
{
    public $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(Request $request)
    {
        return $this->orderService->index($request);
    }

    public function generatePDF()
    {
        return $this->orderService->generatePDF();
    }
}
