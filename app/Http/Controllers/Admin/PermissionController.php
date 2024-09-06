<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    private $permissionRepository;
    private $permission;
    public function __construct(PermissionRepositoryInterface $permissionRepository , Permission $permission)
    {
        $this->permissionRepository = $permissionRepository;
        $this->permission = $permission;
    }
    public function index()
    {
        return $this->permissionRepository->all($this->permission);
    }


    public function create()
    {
        return $this->permissionRepository->create('admin.permissions.create');
    }


    public function store(PermissionStoreRequest $request)
    {
        return $this->permissionRepository->store($this->permission,$request->all());
    }

    public function edit(string $id)
    {
        return $this->permissionRepository->edit($this->permission,$id);
    }


    public function update(PermissionUpdateRequest $request, string $id)
    {
        $this->permissionRepository->update($this->permission,$id,$request->all());
    }
    public function destroy(string $id)
    {
        return $this->permissionRepository->destroy($this->permission,$id);
    }
}
