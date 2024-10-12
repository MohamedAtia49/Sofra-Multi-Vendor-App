<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantContactsRequest;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Review;
use App\Services\RestaurantSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantSettingsController extends Controller
{
    public $restaurantSettingService;

    public function __construct(RestaurantSettingService $restaurantSettingService)
    {
        $this->restaurantSettingService = $restaurantSettingService;
    }
    public function myOffers(){
        return $this->restaurantSettingService->myOffers();
    }

    public function restaurantContactUs(RestaurantContactsRequest $request){
        return $this->restaurantSettingService->restaurantContactUs($request);
    }

    public function myReviews(){
        return $this->restaurantSettingService->myReviews();
    }
}
