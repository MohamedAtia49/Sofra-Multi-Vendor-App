<?php

use App\Http\Controllers\Api\Client\ClientAuthController;
use App\Http\Controllers\Api\Client\ClientOrdersController;
use App\Http\Controllers\Api\Client\ClientSettingsController;
use App\Http\Controllers\Api\Restaurant\RestaurantAuthController;
use App\Http\Controllers\Api\Restaurant\RestaurantOrdersController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\Restaurant\RestaurantSettingsController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    //Main Apis
    Route::controller(MainController::class)->group(function(){
        Route::get('/cities', 'cities');
        Route::get('/regions', 'regions');
        Route::get('/categories', 'categories');
    });
###################################################################################################
    //Client Auth
    Route::controller(ClientAuthController::class)->group(function(){
        Route::post('/client/register', 'clientRegister');
        Route::post('/client/login', 'clientLogin');
        Route::post('/client/send-pin-code', 'clientSendPinCode');
        Route::post('/client/reset-password', 'clientResetPassword');
        //Client Logout (Revoke current login Token)
        Route::delete('/client/logout','clientLogout');
        //Client Add Review for Restaurant
        Route::post('/add-review','addReview');
    });
###################################################################################################
    //Restaurant Auth
    Route::controller(RestaurantAuthController::class)->group(function(){
        Route::post('/restaurant/register', 'restaurantRegister');
        Route::post('/restaurant/login', 'restaurantLogin');
        Route::post('/restaurant/send-pin-code', 'restaurantSendPinCode');
        Route::post('/restaurant/reset-password', 'restaurantResetPassword');
        //Restaurant Logout (Revoke current login Token)
        Route::delete('/restaurant/logout', 'restaurantLogout');
        //Display All Restaurants reviews for Clients
        Route::get('/all-reviews','allReviews');
    });
###################################################################################################
    // Authentications Apis (Must Be logging to run)
    Route::middleware('sanctum')->group(function () {
        //Restaurant Food Items Apis
        Route::controller(MealController::class)->group(function(){
            Route::post('/meals/create', 'addMeal');
            Route::post('/meals/update', 'updateMeal');
            Route::post('/meals/delete', 'deleteMeal');
        });
        //Restaurant Offers Apis
        Route::controller(OfferController::class)->group(function(){
            Route::post('/offers/create', 'addOffer');
            Route::post('/offers/update', 'updateOffer');
            Route::post('/offers/delete', 'deleteOffer');
        });
        #----------------------Client Order Cycle Apis----------------------#
        //(Add Order)
        Route::post('/order/new-order',[OrderController::class,'newOrder']);
        //(Client Orders Control)
        Route::controller(ClientOrdersController::class)->group(function (){
            //(Client Current Orders)
            Route::get('/current-orders', 'clientCurrentOrders');
            //(Client Previous Orders)
            Route::get('/previous-orders', 'clientPreviousOrders');
            //(Client Accept Order)
            Route::post('/client-accept-order', 'clientAcceptOrder');
            //(Client Reject Order)
            Route::post('/client-reject-order', 'clientRejectOrder');
        });
        #----------------------Restaurant Order Cycle Apis----------------------#
        //(Restaurant Orders Control)
        Route::controller(RestaurantOrdersController::class)->group(function (){
            //(Restaurant New Orders)
            Route::get('/restaurant-new-orders', 'restaurantNewOrders');
            //(Restaurant Current Orders)
            Route::get('/restaurant-current-orders', 'restaurantCurrentOrders');
            //(Restaurant Previous Orders)
            Route::get('/restaurant-previous-orders', 'restaurantPreviousOrders');
            //(Restaurant Accept Order)
            Route::post('/restaurant-accept-order', 'restaurantAcceptOrder');
            //(Restaurant Reject Order)
            Route::post('/restaurant-reject-order', 'restaurantRejectOrder');
            //(Restaurant Make Full-Delivered Order)
            Route::post('/restaurant-delivered-order', 'restaurantDeliveredOrder');
        });
###################################################################################################
                    #-----------------Settings Apis-----------------#
        Route::controller(SettingsController::class)->group(function(){
            //Get About_App Content text
            Route::get('/about-app', 'aboutApp');
        });
        //Client Settings Apis
        Route::controller(ClientSettingsController::class)->group(function (){
            //Get All Offers
            Route::get('/all-offers', 'allOffers');
            //Send Contact Message By Client
            Route::post('/client/send-contact', 'clientContactUs');
        });
        //Restaurant Settings Apis
        Route::controller(RestaurantSettingsController::class)->group(function (){
            //Get My Offers (Restaurants)
            Route::get('/my-offers', 'myOffers');
            //Send Contact Message By Restaurant
            Route::get('/restaurant/send-contact', 'restaurantContactUs');
            //Get My Reviews
            Route::get('/my-reviews', 'myReviews');
        });
###################################################################################################
        //Calculate Every Restaurant Commission in App
        Route::get('/restaurant/commission',[CommissionController::class,'calculateCommission']);
    });
});



