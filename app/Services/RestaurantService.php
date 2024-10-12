<?php

namespace App\Services;

use App\Http\Requests\Restaurant\RestaurantAllReviewsRequest;
use App\Http\Requests\Restaurant\RestaurantLoginRequest;
use App\Http\Requests\Restaurant\RestaurantRegisterRequest;
use App\Http\Requests\Restaurant\RestaurantResetPasswordRequest;
use App\Http\Requests\Restaurant\RestaurantSendPinCodeRequest;
use App\Http\Resources\ReviewResource;
use App\Mail\RestaurantResetPassword;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;


class RestaurantService{
    public function restaurantRegister(RestaurantRegisterRequest $request){

        $request->merge(['password'=>bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());
        $categories = $request->categories;
        $restaurant->categories()->attach($categories);
        return responseJson(200 , 'Restaurant Created!' , ['restaurant' => $restaurant]);
    }

    public function restaurantLogin(RestaurantLoginRequest $request){
        Auth::guard('restaurant')->attempt($request->all());
        $restaurant = Auth::guard('restaurant')->user();
        if($restaurant){
            $api_token = $restaurant->createToken('token');
            return responseJson(200,'تم تسجيل الدخول بنجاح',[
                'api_token' => $api_token->plainTextToken,
                'restaurant' =>$restaurant,
            ]);
        }else{
            return responseJson(400,'Email Or Password failed');
        }
    }

    public function sendPinCode(RestaurantSendPinCodeRequest $request){
        $restaurant = Restaurant::where('email',$request->email)->first();
        if($restaurant){
            $code = rand(11111,99999);
            $restaurant->update(['pin_code' => $code]);
            Mail::to($restaurant->email)->send(new RestaurantResetPassword($restaurant));

            if($code){
                return responseJson(200,'تم ارسال الكود الى الايميل االخاص بك يرجى فحص الايميل',[
                    'pin_code' => $code,
                ]);
            }else{
                return responseJson(400,'حدث خطأ يرجى المحاولة مرة اخرى');
            }
        }
    }

    public function resetPassword(RestaurantResetPasswordRequest $request){
        $restaurant = Restaurant::where('pin_code' ,$request->pin_code)->first();
        if($restaurant){
            $restaurant->update(['password' => bcrypt($request->password) , 'pin_code' => null]);
            return responseJson(200 , 'Password changed');
        }else{
            return responseJson(400 , 'code is expired');
        }
    }

    public function allReviews(RestaurantAllReviewsRequest $request){
        $restaurant = Restaurant::find($request->restaurant_id);
        $reviews = $restaurant->reviews()->paginate(3);

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

    public function restaurantLogout(Request $request){

        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);
            $accessToken->delete();
        }
        return responseJson(201,'Successfully logged out');
    }
}
