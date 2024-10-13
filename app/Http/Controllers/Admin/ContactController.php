<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\Admin\ContactService;

class ContactController extends Controller
{
    public $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return $this->contactService->index();
    }
    public function destroy($id)
    {
        return $this->contactService->destroy($id);

    }
}
