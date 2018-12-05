<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;

class UsersService
{
    protected $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->all();
    }

    public function read($id)
    {
        return $this->userRepository->find($id);
    }

    public function create(Request $request)
    {
        return $this->userRepository->create($request->all());
    }

    public function update(User $user,Request $request)
    {
        return $this->userRepository->update($user,$request->all());
    }
}
