<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\RegionResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;

class MainService {
    public function getCities(){
        $cities = City::paginate(5);
        if (count($cities) > 0) {
            if ($cities->total() > $cities->perPage()) {
                $data = [
                    'data' => CityResource::collection($cities),
                    'pagination links' => [
                        'current page' => $cities->currentPage(),
                        'per page' => $cities->perPage(),
                        'total' => $cities->total(),
                        'links' => [
                            'first page' => $cities->url(1),
                            'next page' => $cities->nextPageUrl(),
                            'prev page' => $cities->previousPageUrl(),
                            'last page' => $cities->url($cities->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = CityResource::collection($cities);
            }
            return responseJson(200, 'Cities retrieved successfully', $data);
        }
        return responseJson(404, 'No cities found', []);
    }

    public function getRegions()
    {
        $regions = Region::with('city')->paginate(3);
        if (count($regions) > 0){
            if ($regions->total() > $regions->perPage()){
                $data = [
                    'data' => RegionResource::collection($regions),
                    'pagination links' => [
                        'current page' => $regions->currentPage(),
                        'total' => $regions->total(),
                        'links' => [
                            'first page' => $regions->url(1),
                            'next page' => $regions->nextPageUrl(),
                            'prev page' => $regions->previousPageUrl(),
                            'last page' => $regions->url($regions->lastPage()),
                        ],
                    ],
                ];
            }else{
                $data = RegionResource::collection($regions);
            }
            return responseJson(200, 'Regions retrieved successfully', $data);
        }
        return responseJson(404, 'No regions found', []);
    }

    public function getCategories()
    {
        $categories = Category::paginate(3);
        if (count($categories) > 0){
            if ($categories->total() > $categories->perPage()){
                $data = [
                    'data' => CategoryResource::collection($categories),
                    'pagination link' => [
                        'current page' => $categories->currentPage(),
                        'total' => $categories->total(),
                        'links' => [
                            'first page' => $categories->url(1),
                            'next page' => $categories->nextPageUrl(),
                            'prev page' => $categories->previousPageUrl(),
                            'last page' => $categories->url($categories->lastPage()),
                        ],
                    ],
                ];
            }else{
                $data = CategoryResource::collection($categories);
            }
            return responseJson(200,'Categories retrieved successfully',$data);
        }
        return responseJson(404, 'No categories found', []);
    }
}
