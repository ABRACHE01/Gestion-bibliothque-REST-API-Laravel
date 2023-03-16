<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class AuthController extends Controller
{
   

    
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string|email|unique:users',
    //         'password' => 'required|string|confirmed'
    //     ]);
    //     $user = new User([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'user_role' => 'client'
    //     ]);

    //     $user->save();
        
    //     return response()->json([
    //         'message' => 'Successfully created user!'
    //     ], 201);

    // }


    public function register(Request $request)
    {
     
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => 'client',
            'phone' => $request->phone
        ]);

        $user->save();
        
        return response()->json([
            'message' => 'User registered successfully !',
            'user' => $user
        ], 201);

    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
      
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => ['The provided email is incorrect.']
                ]);
            }elseif(!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => ['The provided password is incorrect.']
                ]);

            }
        }

        return response()->json(["api_token" => $user->createToken('api_token')->plainTextToken]); 

    }
    

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }



}
