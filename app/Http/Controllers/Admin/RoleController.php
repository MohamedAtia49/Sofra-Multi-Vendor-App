<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roleRepository;
    private $role;
    public function __construct(RoleRepositoryInterface $roleRepository , Role $role)
    {
        $this->roleRepository = $roleRepository;
        $this->role = $role;
    }
    public function index()
    {
        return $this->roleRepository->all($this->role);
    }

    public function create()
    {
        return $this->roleRepository->create('admin.roles.create');
    }

    public function store(RoleStoreRequest $request)
    {
        return $this->roleRepository->store($this->role,$request->all());
    }

    public function edit(string $id)
    {
        return $this->roleRepository->edit($this->role,$id);
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        return $this->roleRepository->update($this->role,$id,$request->all());
    }

    public function destroy(string $id)
    {
        return $this->roleRepository->destroy($this->role,$id);
    }
}
