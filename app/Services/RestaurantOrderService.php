<?php

namespace App\Services;

use App\Http\Requests\Restaurant\RestaurantAcceptOrderRequest;
use App\Http\Requests\Restaurant\RestaurantDeliveredOrderRequest;
use App\Http\Requests\Restaurant\RestaurantRejectOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class RestaurantOrderService{

    public function restaurantNewOrders(Request $request)
    {
        $restaurant_id = $request->user()->id;
        $getOrders = Order::with('meals')->where('restaurant_id',$restaurant_id)->where('state','pending')->get();
        $orders = $getOrders->load('meals');
        return responseJson(200,'Pending orders',OrderResource::collection($orders));
    }

    public function restaurantCurrentOrders(Request $request){
        $restaurant_id = $request->user()->id;
        $getOrders = Order::with('meals')->where('restaurant_id',operator: $restaurant_id)->where('state','accepted')->get();
        $orders = $getOrders->load('meals');
        return responseJson(200,'Current orders',OrderResource::collection($orders));
    }

    public function restaurantPreviousOrders(Request $request){
        $restaurant_id = $request->user()->id;
        $getOrders = Order::with('meals')->where('restaurant_id',operator: $restaurant_id)->where('state','delivered')->orWhere('state','rejected')->get();
        $orders = $getOrders->load('meals');
        return responseJson(200,'Previous orders',OrderResource::collection($orders));
    }

    public function restaurantAcceptOrder(RestaurantAcceptOrderRequest $request){

        $findOrder = Order::with('meals')->where('id',$request->order_id)->first();

        if ($findOrder->state == 'pending'){
            $findOrder->update([
                'state' => 'accepted'
            ]);
            $order = $findOrder->load('meals');
            return responseJson(200,'Order accepted ',new OrderResource($order));
        }else{
            return responseJson(400,'Sorry you cant accept this order');
        }
    }

    public function restaurantRejectOrder(RestaurantRejectOrderRequest $request){

        $findOrder = Order::with('meals')->where('id',$request->order_id)->first();

        if ($findOrder->state == 'pending'){
            $findOrder->update([
                'state' => 'rejected'
            ]);
            $order = $findOrder->load('meals');
            return responseJson(200,'Rejected orders',new OrderResource($order));
        }else{
            return responseJson(400,'Sorry you cant reject this order');
        }
    }

    public function restaurantDeliveredOrder(RestaurantDeliveredOrderRequest $request){

        $findOrder = Order::with('meals')->where('id',$request->order_id)->first();

        if ($findOrder->state == 'accepted'){
            $findOrder->update([
                'state' => 'delivered'
            ]);
            $order = $findOrder->load('meals');
            return responseJson(200,'Delivered orders',new OrderResource($order));
        }else{
            return responseJson(400,'Sorry you cant Make this order as delivered');
        }
    }
}
