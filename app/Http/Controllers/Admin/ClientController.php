<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Services\Admin\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    public $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function index(Request $request)
    {
        return $this->clientService->index($request);
    }
    public function destroy($id)
    {
        return $this->clientService->destroy($id);

    }

    public function active($id)
    {
        return $this->clientService->active($id);

    }
    public function deActive($id)
    {
        return $this->clientService->deActive($id);
    }
}
