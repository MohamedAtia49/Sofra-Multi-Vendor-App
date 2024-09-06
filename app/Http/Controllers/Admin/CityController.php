<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityStoreRequest;
use App\Http\Requests\City\CityUpdateRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $cityRepository;
    private $city;
    public function __construct(CityRepositoryInterface $cityRepository , City $city)
    {
        $this->cityRepository = $cityRepository;
        $this->city = $city;
    }
    public function index()
    {
        return $this->cityRepository->all($this->city);
    }
    public function create()
    {
        return $this->cityRepository->create('admin.cities.create');
    }
    public function store(CityStoreRequest $request)
    {
        return $this->cityRepository->store($this->city,$request->all());
    }
    public function edit($id)
    {
        return $this->cityRepository->edit($this->city,$id);
    }
    public function update(CityUpdateRequest $request, $id)
    {
        return $this->cityRepository->update($this->city,$id,$request->all());
    }
    public function destroy($id)
    {
        return $this->cityRepository->destroy($this->city,$id);
    }
}
