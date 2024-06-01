<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Repository\UserRepository;
use App\Models\User;

class UserService
{
    protected $userRepository;
    private $response;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->response = [];
    }

    public function register(UserCreateRequest $request)
    {
        if (!$request->validated()) {
            $this->response['error'] = $request->messages();
            return $this->response;
        }
        $user = $this->fillFields($request);
        $this->userRepository->create($user);
        $this->response['user'] = $this->login($user->cpf, $user->password);
        return $this->response;
    }

    private function fillFields(UserCreateRequest $request): User
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $cpf = $request->input('cpf');
        $password = $request->input('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->cpf = $cpf;
        $newUser->password = $hash;
        return $newUser;
    }

    private function login($cpf, $password)
    {
        $token = auth()->attempt(['cpf' => $cpf, 'password' => $password]);

        if (!$token) {
            $response['error'] = "Error ao Cadastrar Usuário";
            return $response;
        }

        return auth()->user();
    }
}
