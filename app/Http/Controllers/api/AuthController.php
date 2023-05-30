<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|',
            'NIS/NIP' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('authToken')->plainTextToken;
        $success['name'] = $user->username;

        return response()->json([
            'status_code' => 200,
            'message' => 'User registered successfully',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $auth = Auth::user();
            $success['token'] = $auth->createToken('authToken')->plainTextToken;
            $success['username'] = $auth->username;

            return response()->json([
                'status_code' => 200,
                'message' => 'User logged in successfully',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized'
            ]);
        }
    }
}
