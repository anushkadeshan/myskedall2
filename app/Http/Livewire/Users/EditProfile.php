<?php

namespace App\Http\Livewire\Users;

use App\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditProfile extends Component
{
    use LivewireAlert;
    public $user = [];
    public $name;
    public $nickname;
    public $email;
    public $sex;
    public $birth;
    public $phone;
    public $address;
    public $zipcode;
    public $neighborhood;
    public $city;
    public $uf;
    public $profession;
    public $rg;
    public $cpf;
    public $created_at_ip;
    public $last_logging_ip;
    public $inclusion_date;
    public $last_logging_at;

    public function mount($user){
        $this->user = $user;
        $this->name = $user->name;
        $this->nickname = $user->nickname;
        $this->email = $user->email;
        $this->sex = $user->sex;
        $this->birth = $user->birth;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->zipcode = $user->zipcode;
        $this->neighborhood = $user->neighborhood;
        $this->city = $user->city;
        $this->uf = $user->uf;
        $this->profession = $user->profession;
        $this->rg = $user->rg;
        $this->cpf = $user->cpf;
        $this->created_at_ip = $user->created_at_ip;
        $this->last_logging_ip = $user->last_logging_ip;
        $this->inclusion_date = $user->inclusion_date;
        $this->last_logging_at = $user->last_logging_at;
    }

    public function save(){
        $user = User::find($this->user->id);
        $user->name = $this->name;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->sex = $this->sex;
        $user->birth = $this->birth;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->zipcode = $this->zipcode;
        $user->neighborhood = $this->neighborhood;
        $user->city = $this->city;
        $user->uf = $this->uf;
        $user->profession = $this->profession;
        $user->rg = $this->rg;
        $user->cpf = $this->cpf;
        $user->created_at_ip = $this->created_at_ip;
        $user->last_logging_ip = $this->last_logging_ip;
        $user->inclusion_date = $this->inclusion_date;
        $user->last_logging_at = $this->last_logging_at;
        $user->save();

        $this->alert('success', trans('msg.User profile updated successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }
    public function render()
    {
        return view('livewire.users.edit-profile');
    }
}
