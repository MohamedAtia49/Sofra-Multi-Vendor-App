<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminResetPasswordRequest;
use App\Models\User;
use App\Services\Admin\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index(){
        return $this->profileService->index();
    }

    public function changePassword(Request $request){
        return $this->profileService->changePassword($request);
    }

    public function passwordSave(AdminResetPasswordRequest $request)
    {
        return $this->profileService->passwordSave($request);
    }
}

