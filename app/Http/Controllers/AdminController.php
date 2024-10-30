<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->validate([
            'name' => ['string', 'required'],
            'password' => ['string', 'required'],
            'phone' => ['required', 'string', 'unique:admins,phone', 'min:9', 'max:10'],
        ]);
        Admin::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password'])
        ]);



        return response()->json([
            'data' => 'admin registered successfully'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['phone', 'password']);
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        $token = auth('admin')->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }


    public function logout()
    {
        auth('admin')->logout(true, true);

        return response()->json([
            'data' => 'admin Successfully logged out'
        ]);
    }

    public function Admin()
    {
        $admin = auth('admin')->user();

        return response()->json([
            'data' => $admin
        ]);
    }

    
}
