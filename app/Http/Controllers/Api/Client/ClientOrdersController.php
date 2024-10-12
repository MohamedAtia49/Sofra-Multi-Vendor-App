<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ClientAcceptOrderRequest;
use App\Http\Requests\Order\ClientRejectOrderRequest;
use App\Services\ClientOrdersService;
use Illuminate\Http\Request;

class ClientOrdersController extends Controller
{
    public $clientOrdersService;
    public function __construct(ClientOrdersService $clientOrdersService)
    {
        $this->clientOrdersService = $clientOrdersService;
    }
    public function clientCurrentOrders(Request $request){
        $this->clientOrdersService->clientCurrentOrders($request);
    }
    public function clientPreviousOrders(Request $request){
        $this->clientOrdersService->clientPreviousOrders($request);
    }

    public function clientAcceptOrder(ClientAcceptOrderRequest $request){
        $this->clientOrdersService->clientAcceptOrder($request);
    }
    public function clientRejectOrder(ClientRejectOrderRequest $request){
        $this->clientOrdersService->clientRejectOrder($request);
    }
}
