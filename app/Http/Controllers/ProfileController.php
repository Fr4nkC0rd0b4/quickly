<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

    }
}
