<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }
    public function index(Request $request)
    {
        return $this->offerService->index($request);
    }
}
