<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function newOrder (Request $request)
    {
        $validation = validator()->make($request->all(),[
                        'restaurant_id' => 'required|exists:restaurants,id',
                        'meals.*.meal_id' => 'required|exists:meals,id',
                        'meals.*.quantity' => 'required',
                        'address' => 'required',
                        'payment_method' => 'required',
                        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

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
            $commission = settings()->commission * $cost ;
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
            return responseJson(200,'تم انتهاء الطب بنجاح ', $data);
        }else{
            $order->meals()->detach();
            $order->delete();
            return responseJson(0,'الطلب لابد ان لا يكون اقل من'.' '. $restaurant->minimum_charge .' '.'ريال');
        }
    }

    public function clientCurrentOrders(Request $request){
        $client_id = $request->user()->id;
        $orders = Order::where('client_id',$client_id)->where('state','accepted')->get();
        return responseJson(200,'Current orders',$orders);
    }
    public function clientPreviousOrders(Request $request){
        $client_id = $request->user()->id;
        $orders = Order::where('client_id',$client_id)->where('state','delivered')->orWhere('state','declined')->get();
        return responseJson(200,'Current orders',$orders);
    }

    public function clientAcceptOrder(Request $request){
        $validation = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

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
    public function clientRejectOrder(Request $request){
        $validation = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

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

    public function restaurantNewOrders(Request $request){
        $restaurant_id = $request->user()->id;
        $orders = Order::where('restaurant_id',$restaurant_id)->where('state','pending')->get();
        return responseJson(200,'Current orders',$orders);
    }
    public function restaurantCurrentOrders(Request $request){
        $restaurant_id = $request->user()->id;
        $orders = Order::where('restaurant_id',$restaurant_id)->where('state','accepted')->get();
        return responseJson(200,'Current orders',$orders);
    }
    public function restaurantPreviousOrders(Request $request){
        $restaurant_id = $request->user()->id;
        $orders = Order::where('restaurant_id',$restaurant_id)->where('state','delivered')->orWhere('state','rejected')->get();
        return responseJson(200,'Current orders',$orders);
    }

    public function restaurantAcceptOrder(Request $request){
        $validation = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $order = Order::where('id',$request->order_id)->first();

        if ($order->state == 'pending'){
            $order->update([
                'state' => 'accepted'
            ]);
            return responseJson(200,'Current orders',$order);
        }else{
            return responseJson(400,'Sorry you cant accept this order');
        }
    }
    public function restaurantRejectOrder(Request $request){
        $validation = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $order = Order::where('id',$request->order_id)->first();

        if ($order->state == 'pending'){
            $order->update([
                'state' => 'rejected'
            ]);
            return responseJson(200,'Current orders',$order);
        }else{
            return responseJson(400,'Sorry you cant reject this order');
        }
    }
    public function restaurantDeliveredOrder(Request $request){
        $validation = validator()->make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $order = Order::where('id',$request->order_id)->first();

        if ($order->state == 'accepted'){
            $order->update([
                'state' => 'delivered'
            ]);
            return responseJson(200,'Current orders',$order);
        }else{
            return responseJson(400,'Sorry you cant Make this order as delivered');
        }
    }

}

