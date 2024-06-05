<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Repository\UserRepository;
use App\Services\UserCreatedService;
use App\Services\UserLoginService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userCreatedService;
    protected $userLoginService;
    protected $repository;

    public function __construct(UserCreatedService $userCreatedService, UserLoginService $userLoginService, UserRepository $repository)
    {
        $this->userCreatedService = $userCreatedService;
        $this->repository = $repository;
        $this->userLoginService = $userLoginService;
    }

    public function index()
    {
        $users = $this->repository->all(10);
        return response()->json($users, 200);
    }

    public function register(UserCreateRequest $request)
    {
        $response = $this->userCreatedService->register($request);
        return response()->json($response, 201);
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

    public function logout(){
        $response =['message'=>"User logout with success"];
        JWTAuth::invalidate(JWTAuth::getToken());
        return $response;
    }
}
