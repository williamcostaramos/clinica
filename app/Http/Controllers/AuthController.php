<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(UserCreateRequest $request)
    {
        $response = $this->service->register($request);
        return response()->json($response, 201);
    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Não Autorizado'
        ], 401);
    }
}
