<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantAllReviewsRequest;
use App\Http\Requests\Restaurant\RestaurantLoginRequest;
use App\Http\Requests\Restaurant\RestaurantRegisterRequest;
use App\Http\Requests\Restaurant\RestaurantResetPasswordRequest;
use App\Http\Requests\Restaurant\RestaurantSendPinCodeRequest;
use App\Services\RestaurantService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RestaurantAuthController extends Controller
{
    private $restaurantService ;

    public function __construct(RestaurantService $restaurantService){
        $this->restaurantService = $restaurantService;
    }

    public function restaurantRegister(RestaurantRegisterRequest $request){
        return $this->restaurantService->restaurantRegister($request);
    }
    public function restaurantLogin(RestaurantLoginRequest $request){
        return $this->restaurantService->restaurantLogin($request);
    }
    public function restaurantSendPinCode(RestaurantSendPinCodeRequest $request){

        return $this->restaurantService->sendPinCode($request);
    }
    public function restaurantResetPassword(RestaurantResetPasswordRequest $request){

        return $this->restaurantService->resetPassword($request);
    }

    public function allReviews(RestaurantAllReviewsRequest $request){
        return $this->restaurantService->allReviews($request);
    }

    public function restaurantLogout(Request $request){
        Auth::guard('sanctum')->user()->tokens()->delete();
        return responseJson(200,'Successfully logged out');
    }
}
