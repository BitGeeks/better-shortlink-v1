<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
            ]
        ]);
    }

    /**
     * Get a JWT via given credentials.
     * 
     * @param \App\Http\Requests\User\RegisterRequest $request 
     * @return \App\Http\Resources\BaseResource 
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return new BaseResource($user);
    }

    /**
     * Get a JWT via given credentials.
     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function login(Request $request)
    {
        $token = $this->guard()->attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        /** @var \App\Models\User $user */
        $user = $this->guard()->user();
        $user->append('access')
            ->makeHidden([
                'roles', 'permissions'
            ]);

        return new BaseResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['success' => true]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(
            $this->guard()->refresh()
        );
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response([
            'status' => 'success',
            'token_type' => 'bearer',
            'access_token' => $token,
            'user' => $this->guard()->user(),
        ])
            ->header('Authorization', $token);
    }

    /**
     * @return \Tymon\JWTAuth\JWTGuard 
     */
    public function guard(): JWTGuard
    {
        return Auth::guard('api');
    }
}
