<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Services\Admin\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }
    public function index(){
        return $this->restaurantService->index();
    }
    public function destroy($id)
    {
        return $this->restaurantService->destroy($id);
    }

    public function active($id)
    {
        return $this->restaurantService->active($id);
    }
    public function deActive($id)
    {
        return $this->restaurantService->deActive($id);
    }
}
