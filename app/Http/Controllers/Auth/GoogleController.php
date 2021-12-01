<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use App\App;
use Illuminate\Http\Request;
use Session;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        session(['google-id'=> '1236']);
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            //dd($request);
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                session(['group-id'=> $finduser->primary_group_id]);
                session(['user_id'=> $finduser->id]);
                Auth::login($finduser);

                return redirect('/home');

            }else{


                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'created_at_ip' => request()->ip(),
                ]);

                $newUser->groups()->attach(1, ['approved' => 1]);
                $newUser->assignRole('User');
                $apps = App::whereNotIn('app_key',['app_space', 'app_tasks', 'app_approvals'])->pluck('id');
                $assgin_apps = $newUser->apps()->attach($apps);

                session(['group-id'=> $newUser->primary_group_id]);
                session(['user_id'=> $newUser->id]);

                Auth::login($newUser);

                return redirect('/home');
            }

        } catch (Exception $e) {

        }
    }
}
