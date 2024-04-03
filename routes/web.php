<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login')->middleware('guest:web');

Auth::routes(['register' => false]);


Route::middleware(['auth'])->prefix('admin')->group(function () {

    //Admin Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Cities
    Route::resource('/cities', CityController::class);
    //Regions
    Route::resource('/regions', RegionController::class);
    //Categories
    Route::resource('/categories', CategoryController::class);
    //Contacts
    Route::resource('/contacts', ContactController::class);
    //Settings
    Route::resource('/settings', SettingController::class);
    //Settings
    Route::resource('/offers', SettingController::class);
    //Offers
    Route::resource('/offers', OfferController::class);


    //Restaurants
    Route::resource('/restaurants', RestaurantController::class);
    ### Active Restaurant ###
    Route::post('/restaurants-active/{id}',[RestaurantController::class,'active'])->name('restaurants.active');
    ### De Active Restaurant ###
    Route::post('/restaurants-de-active/{id}',[RestaurantController::class,'deActive'])->name('restaurants.deActive');

    //Clients
    Route::resource('/clients', ClientController::class);
    ### Active Restaurant ###
    Route::post('/clients-active/{id}',[ClientController::class,'active'])->name('clients.active');
    ### De Active Restaurant ###
    Route::post('/clients-de-active/{id}',[ClientController::class,'deActive'])->name('clients.deActive');
});
