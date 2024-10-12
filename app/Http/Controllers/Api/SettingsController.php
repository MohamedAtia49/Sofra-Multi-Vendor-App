<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function aboutApp(){
        $about = Setting::find('key','about_app');
        return responseJson(200 , 'About App Content Text' ,$about);
    }
}
