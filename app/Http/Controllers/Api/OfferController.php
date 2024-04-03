<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferCreateRequest;
use App\Http\Requests\Offer\OfferDeleteRequest;
use App\Http\Requests\Offer\OfferUpdateRequest;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    private $offerService ;

    public function __construct(OfferService $offerService){
        $this->offerService = $offerService;
    }
    public function addOffer(OfferCreateRequest $request){
        return $this->offerService->addOffer($request);
    }
    public function updateOffer(OfferUpdateRequest $request){
        return $this->offerService->updateOffer($request);
    }
    public function deleteOffer(OfferDeleteRequest $request){
        return $this->offerService->deleteOffer($request);
    }
}
