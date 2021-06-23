<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Vehicle;

class HelperController extends Controller
{
    public function cities()
    {
        $cities = City::all();

        foreach ($cities as $value) {
           $value->departament;
        }

        return response()->json($cities);
    }

    public function vehicles(Request $request)
    {
        $vehicles = Vehicle::where('user_id', $request->user)->get();

        return response()->json($vehicles);
    }
}
