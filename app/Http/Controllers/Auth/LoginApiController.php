<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    // login function
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->fails()
            ], 401);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Creadentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => auth()->user(),
            'token' => auth()->user()->createToken('apiToken')->plainTextToken
        ], 200);
    }

    // profile
    public function profile()
    {
        try {
            return response()->json([
                'success' => true,
                'data' => User::whereId(auth()->user()->id)->with('childUser')->first()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th
            ], 422);
        }
    }

    // logout
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json([
              'success' => true,
              'message' => 'Logout successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
              'success' => false,
                'error' => $th
            ], 422);
        }
    }
}
