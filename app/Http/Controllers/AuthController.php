<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $response = ['error' => ''];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|digits:11|unique:users,cpf',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return $response;
        }

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

        $newUser->save();

        $token = auth()->attempt(['cpf'=>$cpf, 'password'=>$password]);
        if(!$token){
            $response['error']="Error ao Cadastrar Usuário";
            return $response;
        }

        $response['token']= $token;
        $user = auth()->user();
        $response['user']= $user;

        return $response;


    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Não Autorizado'
        ], 401);
    }


}
