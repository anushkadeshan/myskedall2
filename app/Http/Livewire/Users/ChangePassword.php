<?php

namespace App\Http\Livewire\Users;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ChangePassword extends Component
{
    use LivewireAlert;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $user = [];

    public function save(){
        $user = User::find($this->user->id);
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|different:current_password|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);
        
        if (Hash::check($this->current_password, $user->password)) { 
            $user->fill([
             'password' => Hash::make($this->password)
             ])->save();
         
             $this->alert('success', trans('msg.Password changed.'), [
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 5000,
                'toast' => true,
            ]);
         
         } else {
            $this->alert('error', trans('msg.Password does not match.'), [
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 5000,
                'toast' => true,
            ]);
         }
    }

    public function mount($user){

    }

    public function render()
    {
        return view('livewire.users.change-password');
    }
}
