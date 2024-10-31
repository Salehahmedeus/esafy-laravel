<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->validate([
            'ambulance_id' => ['string', 'required'],
            'user_id' => ['string', 'required'],
            'hospital_id' => ['string', 'required'],
        ]);

        Call::create([
            'ambulance_id' => $input['ambulance_id'],
            'user_id' => $input['user_id'],
            'hospital_id' => $input['hospital_id'],
        ]);



        return response()->json([
            'message' => 'call registered successfully '

        ]);
    }
}
