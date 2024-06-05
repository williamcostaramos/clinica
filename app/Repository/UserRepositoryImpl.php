<?php
namespace App\Repository;
use App\Models\User;
class UserRepositoryImpl implements UserRepository{
    public function all(int $limit=null){
        $query = User::query();
        if(!isset($limit)){
           return $query->paginate(10);
        }
        return $query->paginate($limit);
    }
    public function find($id){
        return User::find($id);
    }
    public function create(User $user){
        $user->save();
    }

}
