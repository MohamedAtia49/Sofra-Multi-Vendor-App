<?php

namespace App\Services;

use App\Http\Requests\Order\ClientAcceptOrderRequest;
use App\Http\Requests\Order\ClientRejectOrderRequest;
use App\Http\Requests\Order\NewOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderService{

    public function makeOrder (NewOrderRequest $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);

        // If restaurant Closed u cant make Order
        if ($restaurant->visibility == 'closed'){
            return responseJson(0,'عذرا المطعم غير متاح فى الوقت الحالى');
        }

        $client = $request->user();
        $order = $request->user()->orders()->create([
            'name' => $client->name,
            'phone' => $client->phone,
            'restaurant_id' => $request->restaurant_id,
            'note' => $request->note,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
        ]);

        $cost = 0 ;
        $delivery_cost = $restaurant->delivery_cost;

        foreach ($request->meals as $m){
            $meal = Meal::find($m['meal_id']);

            $readyMeals = [$m['meal_id'] => [
                'quantity' => $m['quantity'],
                'price' => $meal->price,
                'note' => (isset($m['note'])) ? $m['note'] : '',
            ]];

            $order->meals()->attach($readyMeals);
            $cost += $meal->price * $m['quantity'];
        }

        if ($cost >= $restaurant->minimum_charge){
            $total_price = $cost + $delivery_cost;
            $commission = ($total_price * commission()) / 100 ;
            $net = $total_price - $commission ;
            $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivery_cost,
                'total_price' => $total_price,
                'commission' => $commission,
                'net' => $net,
            ]);
            $restaurant->notifications()->create([
                'title' => 'لديك طلب جديد',
                'content' => 'لديك طلب جديد من العميل ' . $request->user()->name,
                'order_id' => $order->id,
            ]);
            $data = $order->fresh()->load('meals');
            return responseJson(200,'تم انتهاء الطب بنجاح ', new OrderResource($data));
        }else{
            $order->meals()->detach();
            $order->delete();
            return responseJson(0,'الطلب لابد ان لا يكون اقل من'.' '. $restaurant->minimum_charge .' '.'ريال');
        }
    }

}
