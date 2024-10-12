<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use App\Services\MainService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $mainService;

    public function __construct(MainService $mainService){
        $this->mainService = $mainService;
    }
    public function cities(){
        return $this->mainService->getCities();
    }

    public function regions(){
        return $this->mainService->getRegions();

    }
    public function categories(){
        return $this->mainService->getCategories();
    }
}
