<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json([
            'user' => Auth::user()
        ], 200);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users,email,' . $request->user()->id,
        ]);

        $request->user()->update([
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Email updated successfully !',
            'user' => $request->user()
        ], 200);
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Name updated successfully !',
            'user' => $request->user()
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Password updated successfully !',
            'user' => $request->user()
        ], 200);
    }
}
