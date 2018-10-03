<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
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
    protected $redirectTo = '/';

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
     * User login
     *
     * @param UserLoginRequest $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userLogin(UserLoginRequest $request)
    {
        if($user = User::getOld($request->get('email'))){
            return redirect()->route('get_update_password')->with('user', $user);
        }

        $this->login($request);

        return redirect('/');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|email|exist:users,email',
            'password' => 'required|string',
        ],[
            $this->username().'.required'   => 'Не указан E-mail',
            $this->username().'.email'      => 'Не верно указана почьта',
            $this->username().'.exist'      => 'Пользователя с указаной почьтой не существует',
            'password.required'             => 'Не указан пароль',
            'password.string'               => 'Пароль должен быть строкой',
        ]);
    }
}
