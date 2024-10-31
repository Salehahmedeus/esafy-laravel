<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\AmbulanceDriver;
use App\Models\Driver;
use App\Models\Hospital;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;


class DriverController extends Controller
{
    public function store(Request $request)
    {

        $input = $request->validate([
            'name' => ['string', 'required'],
            'driver_license' => ['string', 'required'],
            'phone' => ['required', 'string', 'unique:hospitals,phone', 'min:9', 'max:10'],

        ]);

        Driver::create([
            'name' => $input['name'],
            'driver_license' => $input['driver_license'],
            'phone' => $input['phone'],
        ]);



        return response()->json([
            'message' => 'driver registered successfully '

        ]);
    }

    public function index()
    {

        $hospital = Hospital::where('admin_id', auth('admin')->user()->id)->first();

        if ($hospital) {

            $drivers = Driver::where('hospital_id', $hospital->id)
                ->get();

            return $drivers;

            // $drivers = Driver::where('ambulance_id', $ambulance->id)->get();

            // return response()->json([
            //     'data' => [
            //         'hospital_id' => $hospital->id,
            //         'ambulance_id' => $ambulance->id,
            //         'drivers' => $drivers
            //     ]
            // ]);



        }

        return response()->json(['message' => 'Hospital not found'], 404);
    }
}
