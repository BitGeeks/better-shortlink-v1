<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Queries\PermissionQuery;
use App\Http\Requests\Permission\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\Permission\UpdatePermissionRequest;
use App\Http\Resources\BaseResource;
use App\Models\Permission\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class);
    }

    public function index(PermissionQuery $query)
    {
        $permissions = $query->paginate();

        return BaseResource::collection($permissions);
    }

    public function show(Permission $permission)
    {
        return new BaseResource($permission);
    }

    public function store(CreatePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());

        return new BaseResource($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return new BaseResource($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
