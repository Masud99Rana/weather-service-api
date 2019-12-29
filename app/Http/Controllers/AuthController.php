<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    private $userService;
    private $authService;

    public function __construct(UserService $userService, JWTAuth $auth)
    {
        $this->userService = $userService;
        $this->authService = $auth;

        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(UserLoginRequest $request)
    {   

        $token = $this->authService->attempt(
            $request->only(['email', 'password'])
        );

        if (! $token) {
            return $this->sendError('Wrong credentials','', 401);
        }

        return $this->sendResponse('Token retrieved successfully',[
            'token' => $token,
        ]);
    }

    public function refreshToken()
    {
        $token =  auth()->refresh();

        return $this->sendResponse('Refresh token retrieved successfully',[
            'token' => $token,
        ]);
    }

    public function me(Request $request)
    {
        return $this->sendResponse('Data retrieved successfully', ['Name'=> Auth::user()->name, 'Email' => Auth::user()->email]);
    }

    public function register(UserRegistrationRequest $request)
    {
        $user = $this->userService->create($request->all());

        if (! $user) {
            return $this->sendError('Something is wrong.','', 422);
        }

        return $this->sendResponse('Account created successfully');
    }

    public function logout()
    {
        auth()->logout();
        return $this->sendResponse('Account logged out successfully');
    }
}
