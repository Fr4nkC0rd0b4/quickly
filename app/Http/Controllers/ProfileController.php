<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Location;
use App\PaymentMethod;

class ProfileController extends Controller
{
	public function index(Request $request)
	{
		$user = User::where('id', $request->id)->get();
		$info = ([
			'locations' => [],
			'payment_methods' => []
		]);
		foreach ($user as $key => $value) {
			$info['locations'] = $value->location;
			$info['payment_methods'] = $value->payment_method;
		}

		return json_encode($info);
	}

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->fill($request->except('password'));
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
        	$location = Location::where('user_id', $request->id)->get();
        	dd($location);
        	$location->fill($request->all());
        	$location->save();

        	$payment_method = PaymentMethod::where('user_id', $request->id)->get();
        	$payment_method->fill($request->all());
        	$payment_method->save();
        }
    }
}
