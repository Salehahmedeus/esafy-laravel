<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Hospital;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->validate([
            'phone' => ['required', 'string', 'unique:users,phone', 'min:9', 'max:10'],
            'DOB' => ['required', 'date'],
            'password' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],

        ]);
        Users::create([
            'phone' => $input['phone'],
            'DOB' => $input['DOB'],
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
            'password' => Hash::make($input['password'])
        ]);



        return response()->json([
            'data' => 'user registered successfully'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['phone', 'password']);
        if (!$token = auth('users')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('users')->factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        $token = auth('users')->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('users')->factory()->getTTL() * 60
        ]);
    }


    public function logout()
    {
        auth('users')->logout(true, true);

        return response()->json([
            'data' => 'Successfully logged out'
        ]);
    }

    public function user()
    {
        $user = auth('users')->user();

        return response()->json([
            'data' => $user
        ]);
    }






    public function getNearestHospital(Request $request)
    {
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        $nearestHospital = Hospital::select('latitude', 'longitude')
            ->selectRaw(
                "6371 * sqrt((sin((? * 0.0174532925 - latitude * 0.0174532925) / 2) * sin((? * 0.0174532925 - latitude * 0.0174532925) / 2)) +
            (cos(latitude * 0.0174532925) * cos(? * 0.0174532925) * 
            (sin((? * 0.0174532925 - longitude * 0.0174532925) / 2) * sin((? * 0.0174532925 - longitude * 0.0174532925) / 2))) ) AS distance",
                [$userLatitude, $userLatitude, $userLatitude, $userLongitude, $userLongitude]
            )
            ->orderBy('distance', 'asc')
            ->first();

        if ($nearestHospital) {
            return response()->json($nearestHospital);
        } else {
            return response()->json(
                ['message' => 'No hospitals found nearby'],
                404
            );
        }
    }
}
