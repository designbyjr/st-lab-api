<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponse;

    public function login()
    {
        return "Login Success";
    }

    public function logout()
    {
        return "Logout Success";
    }

    public function register(StoreUserRequest $request)
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
        ]);
    }

}
