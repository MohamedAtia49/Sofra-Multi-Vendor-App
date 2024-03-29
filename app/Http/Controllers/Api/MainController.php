<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cities(){
        $cities = City::all();
        return responseJson(1,'success',$cities->load('regions'));
    }

    public function regions(){
        $regions = Region::all();
        return responseJson(1,'success',$regions->load('city'));
    }
    public function categories(){
        $categories = Category::all();
        return responseJson(1,'success',$categories);
    }
}
