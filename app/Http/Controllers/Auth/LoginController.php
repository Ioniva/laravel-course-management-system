<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
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

    public function sendLoginResponse(Request $request){
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if(auth() -> user() -> role === 'student' ){
            return redirect("/home");
        }

        if (auth() -> user() -> role === 'admin'){
            return redirect("/calendar");
        }

        if (auth() -> user() -> role === 'teacher'){
            return redirect("/calendar");
        }
    }
}
