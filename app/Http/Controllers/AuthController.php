<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repository\UserRepository;
use App\Services\UserLoginService;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    protected $userCreatedService;
    protected $userLoginService;
    protected $repository;

    public function __construct(UserLoginService $userLoginService, UserRepository $repository)
    {
        $this->repository = $repository;
        $this->userLoginService = $userLoginService;
    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Não Autorizado'
        ], 401);
    }

    public function login(LoginRequest $request)
    {
        $response = $this->userLoginService->login($request);
        return response()->json($response, 200);
    }

    public function logout()
    {
        try {
            $response = ['message' => "User logout with success"];
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
