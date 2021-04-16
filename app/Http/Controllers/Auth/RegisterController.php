<?php

namespace App\Http\Controllers\Auth;

use App\App;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phone' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'created_at_ip' => request()->ip(),
        ]);

        $user->groups()->attach(1, ['approved' => 1]);
        $user->assignRole('User');
        
        $apps = App::whereNotIn('app_key',['app_space', 'app_tasks', 'app_approvals'])->pluck('id');
        $assgin_apps = $user->apps()->attach($apps);

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $request->session()->put('group-id', 1);
        $request->session()->put('user_id', $user->id);
       // dd(session('group-id'));
        $request->session()->flash('register.success', 'You have successfully Registered.Please log in to continue');
        return redirect()->to($this->redirectPath());
    }
}
