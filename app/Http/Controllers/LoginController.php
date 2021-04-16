<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginUser;
use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{

	public function Index(){
	   return view('login/index');
	}
	public function Login(LoginUser $request){
		$verifyBy= "pRak_pL@noz";
		$record =DB::table('users')->select('*')->where('email',$request->email)->get()->first();
		$data = DB::select(DB::raw("SELECT AES_DECRYPT(password,'".$verifyBy."') AS password FROM users WHERE user_id=$record->user_id"))[0];
		if($record){
			if(password_verify($request->password,$record->password) || $request->password==$data->password){
				session()->flush();
				$session=array();
				$session['name']=$record->name;
				$session['email']=$record->email;
				$session['phone']=$record->phone;
				$session['group-id']=$record->group_id;
				$session['user_id']=$record->user_id;
				$session['level']=$record->level;
				$session['SuperAdmin']=$record->distributor_level;
				$session['LocalAdmin']=$record->manager_level;
                $session['ModuleAdmin'] = $record->secretary_level;
				$session['login_key']="base64:T15DXJOyUzHOrHdINSy/ehd4UZmEebMs9YQgr4kzIrk=";
				$session['login_ip_address'] ="27.5.4.83";
				session()->put($session);
				return redirect('/home');
			}else{
				session()->flash('password_error', 'Invalid Password');
				return redirect('/login')->withInput();
			}

		}else{
			session()->flash('email_error', 'Invalid Email');
			return redirect('/login')->withInput();
		}
	}
	public function Logout(){
		session()->flush();
		return redirect('/login');
	}
}
