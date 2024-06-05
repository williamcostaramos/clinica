<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserCreatedService;
class UserController extends Controller
{
    protected $userCreatedService;
    protected $repository;

    public function __construct(UserCreatedService $userCreatedService, UserRepository $repository)
    {
        $this->userCreatedService = $userCreatedService;
        $this->repository = $repository;
    }
    public function index()
    {
        $users = $this->repository->all(10);
        return response()->json($users);
    }

    public function register(UserCreateRequest $request)
    {
        $response = $this->userCreatedService->register($request);
        return response()->json($response, 201);
    }
}
