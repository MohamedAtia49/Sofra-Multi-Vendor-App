<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantAcceptOrderRequest;
use App\Http\Requests\Restaurant\RestaurantDeliveredOrderRequest;
use App\Http\Requests\Restaurant\RestaurantRejectOrderRequest;
use App\Models\Order;
use App\Services\RestaurantOrderService;
use Illuminate\Http\Request;

class RestaurantOrdersController extends Controller
{
    public $restaurantOrderService;
    public function __construct(RestaurantOrderService $restaurantOrderService)
    {
        $this->restaurantOrderService = $restaurantOrderService;
    }
    public function restaurantNewOrders(Request $request){
        return $this->restaurantOrderService->restaurantNewOrders($request);
    }
    public function restaurantCurrentOrders(Request $request){
        return $this->restaurantOrderService->restaurantCurrentOrders($request);

    }
    public function restaurantPreviousOrders(Request $request){
        return $this->restaurantOrderService->restaurantPreviousOrders($request);

    }
    public function restaurantAcceptOrder(RestaurantAcceptOrderRequest $request){
        return $this->restaurantOrderService->restaurantAcceptOrder($request);
    }
    public function restaurantRejectOrder(RestaurantRejectOrderRequest $request){
        return $this->restaurantOrderService->restaurantRejectOrder($request);
    }
    public function restaurantDeliveredOrder(RestaurantDeliveredOrderRequest $request){
        return $this->restaurantOrderService->restaurantDeliveredOrder($request);
    }
}
