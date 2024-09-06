<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingStoreRequest;
use App\Http\Requests\Setting\SettingUpdateRequest;
use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    private $settingRepository;
    private $setting;

    public function __construct(SettingRepositoryInterface $settingRepository , Setting $city)
    {
        $this->settingRepository = $settingRepository;
        $this->setting = $city;
    }
    public function index(){
        return $this->settingRepository->all($this->setting);
    }
    public function create()
    {
        return $this->settingRepository->create('admin.settings.create');
    }

    public function store(SettingStoreRequest $request)
    {
        return $this->settingRepository->store($this->setting,$request->all());
    }

    public function edit($id){

        return $this->settingRepository->edit($this->setting,$id);
    }

    public function update(SettingUpdateRequest $request,$id)
    {
        return $this->settingRepository->update($this->setting,$id,$request->all());
    }

    public function destroy($id){
        return $this->settingRepository->destroy($this->setting,$id);
    }
}
