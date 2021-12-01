<?php

namespace App\Http\Livewire\Login;

use App\Group;
use Livewire\Component;

class Index extends Component
{
    public $group;

    public function updatedGroup($value)
    {
        dd($value);
    }

    public function render()
    {
        $groups = Group::select('name','id')->get();
        return view('livewire.login.index')->with('groups',$groups);
    }
}
