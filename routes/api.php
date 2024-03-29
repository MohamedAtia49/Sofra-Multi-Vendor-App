<?php

use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantAuthController;
use App\Http\Controllers\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    //Main
    Route::get('/cities', [MainController::class, 'cities']);   //Middleware ('sanctum');
    Route::get('/regions', [MainController::class, 'regions']);
    Route::get('/categories', [MainController::class, 'categories']);
###########################
    //Client Auth
    Route::post('/client/register', [ClientAuthController::class, 'clientRegister']);
    Route::post('/client/login', [ClientAuthController::class, 'clientLogin'])->name('client.login');
    Route::post('/client/send-pin-code', [ClientAuthController::class, 'clientSendPinCode']);
    Route::post('/client/reset-password', [ClientAuthController::class, 'clientResetPassword']);
###########################
    //Restaurant Auth
    Route::post('/restaurant/register', [RestaurantAuthController::class, 'restaurantRegister']);
    Route::post('/restaurant/login', [RestaurantAuthController::class, 'restaurantLogin'])->name('restaurant.login');
    Route::post('/restaurant/send-pin-code', [RestaurantAuthController::class, 'restaurantSendPinCode']);
    Route::post('/restaurant/reset-password', [RestaurantAuthController::class, 'restaurantResetPassword']);
###########################
    // Authentications Apis
    Route::middleware('sanctum')->group(function () {
        //Restaurant Food Items Apis
        Route::post('/meals/create',[MealController::class,'addMeal']);
        Route::post('/meals/update',[MealController::class,'updateMeal']);
        Route::post('/meals/delete',[MealController::class,'deleteMeal']);
        //Restaurant Offers Apis
        Route::post('/offers/create',[OfferController::class,'addOffer']);
        Route::post('/offers/update',[OfferController::class,'updateOffer']);
        Route::post('/offers/delete',[OfferController::class,'deleteOffer']);
        //Client Order Cycle Apis
        Route::post('/order/new-order',[OrderController::class,'newOrder']);

        //Settings Api
        Route::patch('/settings/update',[MainController::class,'settings']);

    });
});



