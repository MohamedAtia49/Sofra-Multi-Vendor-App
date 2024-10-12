<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientContactsRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Services\ClientSettingService;
use Illuminate\Http\Request;

class ClientSettingsController extends Controller
{

    public $clientSettingService;

    public function __construct(ClientSettingService $clientSettingService)
    {
        $this->clientSettingService = $clientSettingService;
    }
    public function allOffers(){
        return $this->clientSettingService->allOffers();
    }

    public function clientContactUs(ClientContactsRequest $request){
        return $this->clientSettingService->clientContactUs($request);
    }
}
