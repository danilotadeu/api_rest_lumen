<?php

namespace App\Repositories;

use Hash;
use App\User;

class UsersRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->user->create($data);
    }

    public function update(User $user, $data)
    {

        if(!empty($data['name'])){
            $user->name = $data['name'];
        }

        if(!empty($data['email'])){
            $user->email = $data['email'];
        }

        if(!empty($data['password'])){
            $user->password = Hash::make($data['password']);
        }

        if($user->save()){
            return $user;
        }
    }
}
