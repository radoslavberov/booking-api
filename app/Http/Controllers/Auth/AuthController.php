<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken('authtoken')->plainTextToken;

        return response(
            [
                'user' => new UserResource($user),
                'token' => $token,
            ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request['email'])->first();

        $userPassword = $user && Hash::check($request['password'], $user->password);

        if (!$user || !$userPassword) {
            return response()->json([
                'message' => 'Wrong credentials!'
            ], 401);
        }

        $token = $user->createToken('authtoken')->plainTextToken;

        return response(
            [
                'user' => new UserResource($user),
                'token' => $token,
            ], 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out!']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->getAuthPassword())) {
            return response()->json(['message' => 'Invalid old password'], 422);
        }

        auth()->user()->update([
            auth()->user()->password = Hash::make($request->password)
        ]);
        return response()->json(['message' => 'Password successfully updated'], 200);
    }
}
