<?php

namespace App\Services;

use App\Http\Requests\Offer\OfferCreateRequest;
use App\Http\Requests\Offer\OfferDeleteRequest;
use App\Http\Requests\Offer\OfferUpdateRequest;
use App\Models\Offer;

class OfferService{
    public function addOffer(OfferCreateRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $offer = Offer::create([
            'meal_name' => $request->meal_name,
            'meal_description' => $request->meal_description,
            'meal_image' => $request->meal_image,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'restaurant_id' => $restaurant_id,
        ]);

        return responseJson(200,'Offer Created !!',$offer);
    }

    public function updateOffer(OfferUpdateRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $offer = Offer::find($request->id);
        if ($offer->restaurant_id == $restaurant_id){
            $offer->update([
                'meal_name' => $request->meal_name,
                'meal_description' => $request->meal_description,
                'meal_image' => $request->meal_image,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
                'restaurant_id' => $restaurant_id,
            ]);
            return responseJson(200,'Offer Updated!!',$offer);
        }else{
            return responseJson(400,'Not Allowed !!');
        }
    }
    public function deleteOffer(OfferDeleteRequest $request){
        $restaurant_id = auth('sanctum')->user()->id;
        $offer = Offer::find($request->id);
        if ($offer->restaurant_id == $restaurant_id){
            $offer->delete();
            return responseJson(200,'Offer Deleted!!',$offer);
        }else{
            return responseJson(400,'Not Allowed !!');
        }
    }
}
