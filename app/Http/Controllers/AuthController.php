<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use HttpResponse;

    public function login(LoginUserRequest $request): JsonResponse
    {
        $request->validated();

        if(!Auth::attempt ([$request->only('email', 'password')])) {
            return $this->error('', 'Credentials do not match', 401);
        }
        $user = Auth::user();

        return $this->success([
            "user" => $user,
            'bearer_token' => $user->createToken('API Token Of '. $user->name)->plainTextToken
        ],"Login Successful",202);
    }

    public function logout()
    {
        return "Logout Success";
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email ' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'user' => $user,
            'bearer_token' => $user->createToken('API Token Of '. $user->name)->plainTextToken
                                                    ],"Registered Successfully",201);

    }

}
