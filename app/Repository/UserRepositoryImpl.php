<?php
namespace App\Repository;
use App\Models\User;
class UserRepositoryImpl implements UserRepository{
    public function all(){
        return User::all();
    }
    public function find($id){
        return User::find($id);
    }
    public function create(User $user){
        $user->save();
    }

}
