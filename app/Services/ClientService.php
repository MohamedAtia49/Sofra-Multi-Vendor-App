<?php

namespace App\Services;

use App\Http\Requests\Client\ClientAddReviewRequest;
use App\Http\Requests\Client\ClientLoginRequest;
use App\Http\Requests\Client\ClientRegisterRequest;
use App\Http\Requests\Client\ClientResetPasswordRequest;
use App\Http\Requests\Client\ClientSendPinCodeRequest;
use App\Mail\ClientResetPassword;
use App\Models\Client;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientService{
    public function clientRegister(ClientRegisterRequest $request){
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $api_token = $client->createToken('token');
        return responseJson(200,'تم الاضافة بنجاح',[
            'api_token' => $api_token->plainTextToken,
            'client' => $client,
        ]);
    }

    public function clientLogin(ClientLoginRequest $request){
        Auth::guard('client')->attempt($request->all());
        $client = Auth::guard('client')->user();
        if($client){
            $api_token = $client->createToken('token');
            return responseJson(200,'تم تسجيل الدخول بنجاح',[
                'api_token' => $api_token->plainTextToken,
                'client' =>$client,
            ]);
        }else{
            return responseJson(400,'Email Or Password failed');
        }
    }

    public function sendPinCode(ClientSendPinCodeRequest $request){
        $client = Client::where('email',$request->email)->first();
        if($client){
            $code = rand(11111,99999);
            $client->update(['pin_code' => $code]);
            Mail::to($client->email)->send(new ClientResetPassword($client));

            if($code){
                return responseJson(200,'تم ارسال الكود الى الايميل االخاص بك يرجى فحص الايميل',[
                    'pin_code' => $code,
                ]);
            }else{
                return responseJson(400,'حدث خطأ يرجى المحاولة مرة اخرى');
            }
        }
    }

    public function resetPassword(ClientResetPasswordRequest $request){
        $client = Client::where('pin_code' ,$request->pin_code)->first();
        if($client){
            $client->update(['password' => bcrypt($request->password) , 'pin_code' => null]);
            return responseJson(200 , 'Password changed');
        }else{
            return responseJson(400 , 'code is expired');
        }
    }

    public function addReview(ClientAddReviewRequest $request){
        $client = $request->user();
        $review = $client->reviews()->create([
                    'star_rating' => $request->star_rating,
                    'comments' => $request->comments,
                    'restaurant_id' => $request->restaurant_id,
                ]);
        return responseJson(200,'Review Added Successfully !!',$review);
    }
}

