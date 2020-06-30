<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * The user has been authenticated. ANTES DE LOGUEAR SE AUTENTICA Y VERIFICA
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
      //aqui verificamos y condicionamos si el usuario esta activo o no 0=INACTIVO 1=ACTIVO
      if ($user->state === 0) {
        $this->guard()->logout();

        $request->session()->invalidate();

        return back()
          ->withErrors(['email' => trans('auth.failed')]) //mejoramos con el metodo withs
          ->withErrors(['password' => trans('auth.failed')]) //mejoramos con el metodo withs
          ->withInput(request(['email'])); //devolvemos lo q el ususario a escrito en el input usuario
        $this->loggedOut($request) ?: redirect('/');
      } else {
        return redirect('/home');
      }
    }
}
