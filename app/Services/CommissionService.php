<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CommissionService{
    public function getCommission(){
        $restaurant_id = Auth::guard('sanctum')->user()->id;
        $restaurant = Restaurant::find($restaurant_id);
        $orders = Order::where('restaurant_id',$restaurant_id)->get();
        $sales = 0;
        $commission = 0;
        $delivery_cost = $restaurant->delivery_cost;
        foreach ($orders as $order){
            $costs = $order->cost;
            $comm = $order->commission;
            $sales += $costs + $delivery_cost;
            $commission += $comm ;
        }

        $net = $sales - $commission ;

        return responseJson(200,'Commission States',[
            'Sales' => $sales,
            'Commission' => $commission,
            'Net' => $net,
        ]);
    }
}
