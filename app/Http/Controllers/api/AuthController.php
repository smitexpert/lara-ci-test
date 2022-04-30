<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // create new user
    public function createNewUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'dob' => 'required',
            'phone' => 'required'
        ]);

        $user = User::create([
            'name' => $request->get('username'),
            'email' => $request->get('email'),
            'dob' => $request->get('dob'),
            'password' => bcrypt($request->get('password')),
            'phone' => $request->get('phone'),
            'username' => $request->get('username'),
        ]);

        return response([
            'status' => 200,
            'message' => 'User created successfully',
            'token' => $this->getToken($user)
        ], 200);
    }

    // login controller
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response([
                'status' => 401,
                'message' => 'Email or password is wrong'
            ], 401);
        } else {
            return response([
                'status' => 200,
                'message' => 'User logged-in successfully',
                'token' => $this->getToken($user)
            ]);
        }
    }

    public function logOut(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response([
           'status' => 200,
           'message' => 'User logged out'
        ]);
    }

    // create a new token for user
    public function getToken(User $user): string
    {
        return $user->createToken('my-app-token')->plainTextToken;
    }
}
