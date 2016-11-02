<?php

namespace Coclus\Http\Controllers\Auth;

use Coclus\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Http\Request;
use Coclus\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/set_profile';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|alpha',
            'lastname' => 'required|max:255|alpha',
            'comuna' => 'required',
            'username' => 'required|max:255|unique:users|alpha_num',
            'address' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'username' => $data['username'],
            'comuna' => $data['comuna'],
            'profile_type' => $data['profile_type'],
            'lastname' => $data['lastname'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function postRegisterForm(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (array_key_exists("profile_type", $request->input()) || $request->input("profile_type") != "") {
            Auth::guard($this->getGuard())->login($this->create($request->all()));
        }

        return redirect($this->redirectPath());
    }
}
