<?php

namespace App\Services;

use App\Http\Requests\Meal\AddMealRequest;
use App\Http\Requests\Meal\DeleteMealRequest;
use App\Http\Requests\Meal\UpdateMealRequest;
use App\Models\Meal;

class MealService{
    public function addMeal(AddMealRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $meal = Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'processing_time' => $request->processing_time,
            'restaurant_id' => $restaurant_id,
        ]);
        return responseJson(200,'Meal Created !!' ,$meal);
    }

    public function updateMeal(UpdateMealRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $meal = Meal::find($request->id);
        if ($meal->restaurant_id == $restaurant_id){
            $meal->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'offer_price' => $request->offer_price,
                'processing_time' => $request->processing_time,
                'restaurant_id' => $restaurant_id,
            ]);
            return responseJson(200,'Meal Updated !!' ,$meal);
        }else{
            return responseJson(400,'Not Allowed !!');
        }
    }

    public function deleteMeal(DeleteMealRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $meal = Meal::find($request->id);
        if ($meal->restaurant_id == $restaurant_id){
            $meal->delete();
            return responseJson(200,'Meal Deleted !!' ,$meal);
        }else{
            return responseJson(400,'Not Allowed !!');
        }
    }
}
