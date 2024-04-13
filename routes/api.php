<?php

use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantAuthController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\OfferController;
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
    //Main Apis
    Route::get('/cities', [MainController::class, 'cities']);   //Middleware ('sanctum');
    Route::get('/regions', [MainController::class, 'regions']);
    Route::get('/categories', [MainController::class, 'categories']);
###################################################################################################
    //Client Auth
    Route::post('/client/register', [ClientAuthController::class, 'clientRegister']);
    Route::post('/client/login', [ClientAuthController::class, 'clientLogin'])->name('client.login');
    Route::post('/client/send-pin-code', [ClientAuthController::class, 'clientSendPinCode']);
    Route::post('/client/reset-password', [ClientAuthController::class, 'clientResetPassword']);
###################################################################################################
    //Restaurant Auth
    Route::post('/restaurant/register', [RestaurantAuthController::class, 'restaurantRegister']);
    Route::post('/restaurant/login', [RestaurantAuthController::class, 'restaurantLogin'])->name('restaurant.login');
    Route::post('/restaurant/send-pin-code', [RestaurantAuthController::class, 'restaurantSendPinCode']);
    Route::post('/restaurant/reset-password', [RestaurantAuthController::class, 'restaurantResetPassword']);
###################################################################################################
    // Authentications Apis (Must Be logging to run)
    Route::middleware('sanctum')->group(function () {
        //Restaurant Food Items Apis
        Route::post('/meals/create',[MealController::class,'addMeal']);
        Route::post('/meals/update',[MealController::class,'updateMeal']);
        Route::post('/meals/delete',[MealController::class,'deleteMeal']);
        //Restaurant Offers Apis
        Route::post('/offers/create',[OfferController::class,'addOffer']);
        Route::post('/offers/update',[OfferController::class,'updateOffer']);
        Route::post('/offers/delete',[OfferController::class,'deleteOffer']);
        #----------------------Client Order Cycle Apis----------------------#
        //(Add Order)
        Route::post('/order/new-order',[OrderController::class,'newOrder']);
        //(Client Current Orders)
        Route::get('/current-orders',[OrderController::class,'clientCurrentOrders']);
        //(Client Previous Orders)
        Route::get('/previous-orders',[OrderController::class,'clientPreviousOrders']);
        //(Client Accept Order)
        Route::post('/client-accept-order',[OrderController::class,'clientAcceptOrder']);
        //(Client Reject Order)
        Route::post('/client-reject-order',[OrderController::class,'clientRejectOrder']);
        #----------------------Restaurant Order Cycle Apis----------------------#
        //(Restaurant New Orders)
        Route::get('/restaurant-new-orders',[OrderController::class,'restaurantNewOrders']);
        //(Restaurant Current Orders)
        Route::get('/restaurant-current-orders',[OrderController::class,'restaurantCurrentOrders']);
        //(Restaurant Previous Orders)
        Route::get('/restaurant-previous-orders',[OrderController::class,'restaurantPreviousOrders']);
        //(Restaurant Accept Order)
        Route::post('/restaurant-accept-order',[OrderController::class,'restaurantAcceptOrder']);
        //(Restaurant Reject Order)
        Route::post('/restaurant-reject-order',[OrderController::class,'restaurantRejectOrder']);
        //(Restaurant Make Full-Delivered Order)
        Route::post('/restaurant-delivered-order',[OrderController::class,'restaurantDeliveredOrder']);
###################################################################################################
        //Client Add Review for Restaurant
        Route::post('/add-review',[ClientAuthController::class,'addReview']);
        //Display All Restaurants reviews for Clients
        Route::get('/all-reviews',[RestaurantAuthController::class,'allReviews']);
###################################################################################################
        #-----------------Client Settings Apis-----------------#
        //Get All Offers
        Route::get('/all-offers',[SettingsController::class,'allOffers']);
        //Send Contact Message By Client
        Route::post('/client/send-contact',[SettingsController::class,'clientContactUs']);
        //Get About_App Content text
        Route::get('/about-app',[SettingsController::class,'aboutApp']);
        //Client Logout (Delete All Tokens)
        Route::delete('/client/logout', [ClientAuthController::class, 'clientLogout']);
        #-----------------Restaurant Settings Apis-----------------#
        //Get My Offers (Restaurants)
        Route::get('/my-offers',[SettingsController::class,'myOffers']);
        //Send Contact Message By Restaurant
        Route::post('/restaurant/send-contact',[SettingsController::class,'restaurantContactUs']);
        //Get About_App Content text
        Route::get('/about-app',[SettingsController::class,'aboutApp']);
        //Get My Reviews
        Route::get('/my-reviews',[SettingsController::class,'myReviews']);
        //Restaurant Logout (Delete All Tokens)
        Route::get('/restaurant/logout', [RestaurantAuthController::class, 'restaurantLogout']);
###################################################################################################
        //Calculate Every Restaurant Commission in App
        Route::get('/restaurant/commission',[CommissionController::class,'commission']);
    });
});



