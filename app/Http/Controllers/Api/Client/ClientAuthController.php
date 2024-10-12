<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientAddReviewRequest;
use App\Http\Requests\Client\ClientLoginRequest;
use App\Http\Requests\Client\ClientRegisterRequest;
use App\Http\Requests\Client\ClientResetPasswordRequest;
use App\Http\Requests\Client\ClientSendPinCodeRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ClientAuthController extends Controller
{
    private $clientService;
    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }

    public function clientRegister(ClientRegisterRequest $request){

        return $this->clientService->clientRegister($request);

    }
    public function clientLogin(ClientLoginRequest $request){

        return $this->clientService->clientLogin($request);

    }

    public function clientSendPinCode(ClientSendPinCodeRequest $request){

        return $this->clientService->sendPinCode($request);
    }
    public function clientResetPassword(ClientResetPasswordRequest $request){

        return $this->clientService->resetPassword($request);
    }

    public function addReview(ClientAddReviewRequest $request){

        return $this->clientService->addReview($request);
    }

    public function clientLogout(Request $request){
        return $this->clientService->clientLogout($request);
    }
}
