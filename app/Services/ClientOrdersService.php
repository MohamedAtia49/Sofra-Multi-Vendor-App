<?php

namespace App\Services;

use App\Http\Requests\Order\ClientAcceptOrderRequest;
use App\Http\Requests\Order\ClientRejectOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientOrdersService{
    public function clientCurrentOrders(Request $request)
    {
        $client_id = $request->user()->id;
        $orders = Order::where('client_id',$client_id)->where('state','accepted')->get();
        return responseJson(200,'Current orders',$orders);
    }
    public function clientPreviousOrders(Request $request)
    {
        $client_id = $request->user()->id;
        $orders = Order::where('client_id',$client_id)->where('state','delivered')->orWhere('state','declined')->get();
        return responseJson(200,'Current orders',$orders);
    }

    public function clientAcceptOrder(ClientAcceptOrderRequest $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        if($order->state == 'accepted'){
            $order->update([
                'state' => 'delivered'
            ]);
            return responseJson(200,'Order Delivered Successfully',$order);
        }else{
            return responseJson(400,'Sorry you cant accept this order');
        }
    }

    public function clientRejectOrder(ClientRejectOrderRequest $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        if($order->state == 'accepted'){
            $order->update([
                'state' => 'declined'
            ]);
            return responseJson(200,'Order Delivered Successfully',$order);
        }else{
            return responseJson(400,'Sorry you cant reject this order');
        }
    }
}
