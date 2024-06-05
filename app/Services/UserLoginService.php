<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;

class UserLoginService
{
    private $response;

    public function __construct()
    {
        $this->response = [];
    }

    public function login(LoginRequest $request){

        if(!$request->validated()){
            $this->response['error']="Bad Credentials";
            return $this->response;
        }

        $cpf = $request->input('cpf');
        $password= $request->input('password');

        $token = auth()->attempt(['cpf' => $cpf, 'password' => $password]);

        if(!$token){
            $this->response['error']="Bad Credentials";
            return $this->response;
        }

        $this->response['token']= $token;
        $user = auth()->user();

        $this->response['user']= $user;
        return $this->response;

    }
}
