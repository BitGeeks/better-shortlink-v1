<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Queries\RoleQuery;
use App\Http\Requests\Permission\Role\CreateRoleRequest;
use App\Http\Requests\Permission\Role\UpdateRoleRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\RoleResource;
use App\Models\Permission\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    public function index(RoleQuery $query)
    {
        $roles = $query->paginate();

        return BaseResource::collection($roles);
    }

    public function show(Role $role)
    {
        $role->load('permissions');

        return new RoleResource($role);
    }

    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->validated());

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return new BaseResource($role);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return new BaseResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
