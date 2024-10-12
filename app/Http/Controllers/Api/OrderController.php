<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ClientAcceptOrderRequest;
use App\Http\Requests\Order\ClientRejectOrderRequest;
use App\Http\Requests\Order\NewOrderRequest;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function newOrder(NewOrderRequest $request)
    {
        return $this->orderService->makeOrder($request);
    }

}

