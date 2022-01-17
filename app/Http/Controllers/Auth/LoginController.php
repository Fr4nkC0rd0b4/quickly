<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*protected function redirectTo() {
        $role = auth()->user()->role->name;
        
        $redirectTo = '';

        switch ($role) {
            case 'admin':
                $redirectTo = '/home';
                break;
            case 'tic':
                $redirectTo = '/admin';
                break;

            case 'user':
                $redirectTo = '/spa/travels';
                break;

            case 'quickero':
                $redirectTo = '/spa/deliveries';
                break;
            default:
                $redirectTo = '/home';
                break;
        }

        return $redirectTo;
    }*/
}
