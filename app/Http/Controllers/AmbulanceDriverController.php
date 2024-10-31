<?php

namespace App\Http\Controllers;

use App\Models\AmbulanceDriver;
use Illuminate\Http\Request;

class AmbulanceDriverController extends Controller
{
    public function store(Request $request){

        $input = $request->validate([
            'ambulance_id' => ['string', 'required'],
            'driver_id' => ['string', 'required'],
        ]);

        AmbulanceDriver::create([
            'ambulance_id' => $input['ambulance_id'],
            'driver_id' => $input['driver_id'],
        ]);



        return response()->json([
            'message' => 'driver registered successfully to ambulance'

        ]);
    }
}
