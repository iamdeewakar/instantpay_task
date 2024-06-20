<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    //
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRequest $request)
    {
        try {

            $user = $this->userRepository->createUser([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),

            ]);
            $message = "User registered successfully";
            return ApiResponse::success($user,$message, 201);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('my_api_token')->plainTextToken;
            $data = [
                'user' => $user,
                'access_token' => $token
            ];
            $message = "Logged in successfully";
            return ApiResponse::success($data, $message, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
