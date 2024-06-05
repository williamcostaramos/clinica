<?php
namespace App\Repository;
use App\Models\User;

interface UserRepository{
    public function find($id);
    public function all(int $limit);
    public function create(User $user);
}
