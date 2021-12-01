<?php

namespace App\Http\Livewire\Login;

use App\Group;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthGroup extends Component
{
    public $groups = [];
    public $group;

    public function mount($groups){
        $this->groups = $groups;
    }

    public function updatedGroup($group_id){
        $approved_groups = Group::whereHas('users', function ($query) {
            return $query->where(['user_id'=> Auth::id(), 'approved'=> 1]);
        })->pluck('id')->toArray();

        $ok = in_array($group_id,$approved_groups);
        if($ok){
            session(['group-id'=> $group_id]);
        }
        else{
            session(['group-id'=> 1]);
        }

        redirect()->to('/home');
    }

    public function render()
    {
        return view('livewire.login.auth-group');
    }
}
