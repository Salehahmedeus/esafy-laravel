<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Admin;


class HospitalController extends Controller
{
    public function registerHospital(Request $request)
    {

        $hospitalCount = Hospital::count();
        if (!$hospitalCount == 0) {
            return response()->json([
                'message' => ' there is alradey a hospital  '
            ]);
        } else {
            $input = $request->validate([
                'name' => ['string', 'required'],
                'address' => ['string', 'required'],
                'phone' => ['required', 'string', 'unique:hospitals,phone', 'min:9', 'max:10'],

            ]);

            Hospital::create([
                'name' => $input['name'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                'admin_id' => auth("admin")->user()->id,
            ]);



            return response()->json([
                'message' => 'hospital registered successfully '

            ]);
        }
    }


    public function index()
    {
        $hospital = Hospital::where('admin_id', auth('admin')->user()->id)->get();



        return response()->json([
            'data' => $hospital
        ]);
    }
}
