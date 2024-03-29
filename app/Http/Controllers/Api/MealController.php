<?php

namespace App\Http\Controllers\Api;

use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Services\MealService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Meal\AddMealRequest;
use App\Http\Requests\Meal\DeleteMealRequest;
use App\Http\Requests\Meal\UpdateMealRequest;

class MealController extends Controller
{
    private $mealService;
    public function __construct(MealService $mealService){
        $this->mealService = $mealService;
    }
    public function addMeal(AddMealRequest $request){
        return $this->mealService->addMeal($request);
    }

    public function updateMeal(UpdateMealRequest $request){
        return $this->mealService->updateMeal($request);
    }
    public function deleteMeal(DeleteMealRequest $request){
        return $this->mealService->deleteMeal($request);
    }
}
