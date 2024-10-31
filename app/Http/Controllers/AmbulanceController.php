<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Hospital;
use Illuminate\Http\Request;


class AmbulanceController extends Controller
{
    public function store(Request $request)
    {

        $hospital = Hospital::where('admin_id', auth('admin')->user()->id)->first();
        $input = $request->validate([
            'status' => ['string', 'required'],
            'license_number' => ['string', 'required'],
            'latitude' => ['string', 'required'],
            'longitude' => ['string', 'required'],

        ]);

        Ambulance::create([
            'status' => $input['status'],
            'license_number' => $input['license_number'],
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
            'hospital_id' => $hospital->id,
        ]);



        return response()->json([
            'message' => 'driver registered successfully '

        ]);
    }

    
}
