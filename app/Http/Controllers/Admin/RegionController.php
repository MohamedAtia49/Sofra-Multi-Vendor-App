<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Region\RegionStoreRequest;
use App\Interfaces\RegionRepositoryInterface;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    private $regionRepository;
    private $region;

    public function __construct(RegionRepositoryInterface $regionRepositoryInterface , Region $region)
    {
        $this->regionRepository = $regionRepositoryInterface;
        $this->region = $region;
    }
    public function index()
    {
        return $this->regionRepository->all($this->region);
    }
    public function create()
    {
        return $this->regionRepository->create('admin.regions.create');
    }
    public function store(RegionStoreRequest $request)
    {
        return $this->regionRepository->store($this->region,$request->all());
    }
    public function edit($id)
    {
        return $this->regionRepository->edit($this->region,$id);
    }
    public function update(Request $request, $id)
    {
        return $this->regionRepository->update($this->region,$id,$request->all());
    }
    public function destroy($id)
    {
        return $this->regionRepository->destroy($this->region,$id);
    }
}
