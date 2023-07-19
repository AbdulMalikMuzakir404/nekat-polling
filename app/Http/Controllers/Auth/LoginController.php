<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Request;
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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $login = request()->input('nis');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';
        request()->merge([$field => $login]);
        return $field;
    }

    public function redirectTo()
    {
        if (Auth::user()->role === 'siswa') {
            if (Auth::user()->voting === 1) {
                $redirectTo = route('siswa.success');
                return $redirectTo;
            }
            
            $redirectTo = route('siswa.home');
            return $redirectTo;
        }

        $redirectTo = route('admin.home');
        return $redirectTo;
    }
}
