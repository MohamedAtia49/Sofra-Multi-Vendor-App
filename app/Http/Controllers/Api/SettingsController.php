<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    //Client Settings Api
    public function allOffers(){
        $offers = Offer::all();
        return responseJson(200,'All Offers',$offers);
    }

    public function clientContactUs(Request $request){
        $validation = Validator::Make($request->all(),[
            'name' => 'required',
            'email' => 'required|exists:clients,email',
            'phone' => 'required',
            'message_type' => 'required',
            'message' => 'required',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $contact = Contact::create($request->all());
        return responseJson(200,'Contact Send Successfully!',$contact);
    }

    public function aboutApp(){
        $settings = Setting::find(1);
        $about = $settings->about_app;

        return responseJson(200 , 'About App Content Text!' ,$about);
    }

    //Restaurant Settings Apis
    public function myOffers(){
        $restaurant_id = Auth::guard('sanctum')->user()->id;
        $offers = Offer::where('restaurant_id',$restaurant_id)->get();

        return responseJson(200,'My Offers !',$offers);
    }

    public function restaurantContactUs(Request $request){
        $validation = Validator::Make($request->all(),[
            'name' => 'required',
            'email' => 'required|exists:restaurants,email',
            'phone' => 'required',
            'message_type' => 'required',
            'message' => 'required',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $contact = Contact::create($request->all());
        return responseJson(200,'Contact Send Successfully!',$contact);
    }

    public function myReviews(){
        $restaurant_id = Auth::guard('sanctum')->user()->id;
        $reviews = Review::where('restaurant_id',$restaurant_id)->get();

        return responseJson(200,'My Reviews !',$reviews);
    }

}
