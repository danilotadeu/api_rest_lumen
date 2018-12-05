<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsersService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\EditUserRequest;

class UsersController extends Controller{

    protected $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        $users = $this->userService->index();

        return UserResource::collection($users);
    }

    public function show($id)
    {

        $user = $this->userService->read($id);

        return new UserResource($user);
    }

    public function store(UserRequest $request)
    {

        $user = $this->userService->create($request);

        return new UserResource($user);
    }

    public function update($id,EditUserRequest $request)
    {

        $user = $this->userService->read($id);

        $user_update = $this->userService->update($user,request());

        return new UserResource($user_update);
    }

    public function destroy($id)
    {
        $user = $this->userService->read($id);

        if($user->delete()){
            return response()->json([
                'message' => 'deleted user'
            ], 200);
        }
    }

}