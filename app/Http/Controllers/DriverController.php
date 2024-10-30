<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function store(Request $request){
        $input = $request->validate([
            'name' => ['string', 'required'],
            'address' => ['string', 'required'],
            'latitude' => ['string', 'required'],
            'longitude' => ['string', 'required'],
            'phone' => ['required', 'string', 'unique:hospitals,phone', 'min:9', 'max:10'],

        ]);

        Driver::create([
            'name' => $input['name'],
            'address' => $input['address'],
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
            'phone' => $input['phone'],
            'admin_id' => auth("admin")->user()->id,
        ]);



        return response()->json([
            'message' => 'hospital registered successfully '

        ]);
    }
}
