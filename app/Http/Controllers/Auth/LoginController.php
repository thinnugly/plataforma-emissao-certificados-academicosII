<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        if(Auth::user()->hasRole('administrator'))
        {
            return '/administrator';
        }
        elseif(Auth::user()->hasRole('office'))
        {
            return '/office';
        }elseif(Auth::user()->hasRole('student'))
        {
            return '/student';
        }elseif(Auth::user()->hasRole('director'))
        {
            return '/director';
        }elseif(Auth::user()->hasRole('office_titular'))
        {
            return '/office/titular';
        }
        elseif(Auth::user()->hasRole('professor'))
        {
            return '/professor';
        }

    }
}
