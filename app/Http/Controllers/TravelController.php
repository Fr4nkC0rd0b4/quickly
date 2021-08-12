<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;
use Auth;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role->name;
        $id = Auth::user()->id;
        
        switch ($role) {
            case 'user':
                $travels = Travel::search($request->searching)->orderBy('id', 'DESC')->paginate(30);
                break;
            case 'quickero':
                $travels = Travel::where('user_id', $id)->search($request->searching)->orderBy('id', 'DESC')->paginate(30);
                break;

            default:
                $travels = Travel::search($request->searching)->orderBy('id', 'DESC')->paginate(30);
                break;
        }

        foreach ($travels as $value) {
            $value->vehicle;
            $value->user;
        }

        return response()->json($travels);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $travel = new Travel();
        $travel->fill($request->all());

        $travel->save();
    }
}
