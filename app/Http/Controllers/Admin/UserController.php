<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Queries\UserQuery;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(UserQuery $query)
    {
        $users = $query->paginate();

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user->load('role');
        return new UserResource($user);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->role()->sync($request->role_id);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->role()->sync($request->role_id);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
