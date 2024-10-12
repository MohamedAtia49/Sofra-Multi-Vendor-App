<?php

namespace App\Services;

use App\Http\Requests\Restaurant\RestaurantContactsRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ReviewResource;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class RestaurantSettingService{

    public function myOffers(){

        $restaurant_id = Auth::guard('sanctum')->user()->id;
        $offers = Offer::where('restaurant_id',$restaurant_id)->paginate(3);
        if (count($offers) > 0) {
            if ($offers->total() > $offers->perPage()) {
                $data = [
                    'data' => OfferResource::collection($offers),
                    'pagination links' => [
                        'current page' => $offers->currentPage(),
                        'per page' => $offers->perPage(),
                        'total' => $offers->total(),
                        'links' => [
                            'first page' => $offers->url(1),
                            'next page' => $offers->nextPageUrl(),
                            'prev page' => $offers->previousPageUrl(),
                            'last page' => $offers->url($offers->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = OfferResource::collection($offers);
            }
            return responseJson(200 , 'All offers retrieved', $data);
        }
        return responseJson(404, 'No offers found', []);
    }

    public function restaurantContactUs(RestaurantContactsRequest $request){

        $contact = Contact::create($request->all());
        return responseJson(200,'Contact Send Successfully!',ContactResource::collection($contact));
    }

    public function myReviews(){
        $restaurant_id = Auth::guard('sanctum')->user()->id;
        $reviews = Review::with('client','restaurant')->where('restaurant_id',$restaurant_id)->paginate(3);
        if (count($reviews) > 0) {
            if ($reviews->total() > $reviews->perPage()) {
                $data = [
                    'data' => ReviewResource::collection($reviews),
                    'pagination links' => [
                        'current page' => $reviews->currentPage(),
                        'per page' => $reviews->perPage(),
                        'total' => $reviews->total(),
                        'links' => [
                            'first page' => $reviews->url(1),
                            'next page' => $reviews->nextPageUrl(),
                            'prev page' => $reviews->previousPageUrl(),
                            'last page' => $reviews->url($reviews->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = ReviewResource::collection($reviews);
            }
            return responseJson(200 , 'All reviews retrieved', $data);
        }
        return responseJson(404, 'No reviews found', []);
    }
}
