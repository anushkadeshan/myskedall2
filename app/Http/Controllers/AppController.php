<?php

namespace App\Http\Controllers;

use App\App;
use App\User;
use App\Group;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function assignAppstoGroup(Request $request){
        $group = Group::find($request->group_id);

        if (is_null($request->apps)) {
            $apps = App::where('active',true)->get()->pluck('id');
        } 
        else{
            $apps = $request->apps;
        }
       // dd($apps);
        $insert = $group->apps()->sync($apps);
        if($insert){
            toast(trans('msg.Apps assigned to Group successfully.'),'success','top-right')->showCloseButton();
            return redirect(route('groups.index'));
        }
        else{
            Flash::success('Something Error.');
            return redirect(route('groups.index'));
        }
        
    }

    public function assignAppstoUser(Request $request)
    {    
        $user = User::find($request->user_id);
        $apps = $request->apps;
        
        // dd($apps);
        $insert = $user->apps()->sync($apps);
        if ($insert) {
            toast(trans('msg.Apps assigned to User successfully.'),'success','top-right')->showCloseButton();
            return redirect(route('users.index'));
        } else {
            Flash::success('Something Error.');
            return redirect(route('users.index'));
        }
    }
}
