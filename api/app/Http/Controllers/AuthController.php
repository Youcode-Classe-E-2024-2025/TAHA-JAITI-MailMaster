<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }



    public function login(Request $request)
    {
        $res = $this->authService->login($request);

        return $res ? Res::success($res, 'Login successful') : Res::error('Login failed', 401);
    }


    public function register(Request $request)
    {
        $res = $this->authService->register($request);

        return $res ? Res::success($res, 'Registration successful') : Res::error('Registration failed', 401);
    }

}
