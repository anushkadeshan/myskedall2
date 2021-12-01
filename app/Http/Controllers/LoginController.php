<?php

namespace App\Http\Controllers;
use DB;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

	public function Index(){
        $groups = Group::select('name','id')->get();
	   return view('login/new')->with('groups',$groups);
	}

    public function authGroup(){
        $groups = Group::whereHas('users', function ($query) {
            return $query->where(['user_id'=> Auth::id(), 'approved'=> 1]);
        })->select('name','id')->get('id');
	    return view('login/auth-group')->with('groups',$groups);
	}


    public function authGroupLogin(Request $request){
        $approved_groups = Group::whereHas('users', function ($query) {
            return $query->where(['user_id'=> Auth::id(), 'approved'=> 1]);
        })->pluck('id')->toArray();

        $ok = in_array($request->group_id,$approved_groups);
        if($ok){
            session(['group-id'=> $request->group_id]);
        }
        else{
            session(['group-id'=> 1]);
        }
        return redirect('/home');


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
