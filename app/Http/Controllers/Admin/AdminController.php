<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    private $adminRepository;
    private $admin;
    public function __construct(AdminRepositoryInterface $adminRepository , User $admin)
    {
        $this->adminRepository = $adminRepository;
        $this->admin = $admin;
    }
    public function index()
    {
        return $this->adminRepository->all($this->admin);
    }
    public function create()
    {
        return $this->adminRepository->create('admin.admins.create');
    }

    public function store(AdminStoreRequest $request)
    {
        return $this->adminRepository->store($this->admin,$request->all());
    }
    public function edit(string $id)
    {
        return $this->adminRepository->edit($this->admin,$id);
    }
    public function update(AdminUpdateRequest $request, string $id)
    {
        return $this->adminRepository->update($this->admin,$id,$request->all());
    }
    public function destroy(string $id)
    {
        return $this->adminRepository->destroy($this->admin,$id);
    }
}
