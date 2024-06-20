<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
}
