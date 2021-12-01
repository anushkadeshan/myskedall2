<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\Models\Approvals\Level;
use App\Models\User;
use Livewire\Component;

class CreateLevels extends Component
{
    public $name;
    public $type;
    public $description;
    public $max_value;

    public $aprrover_id;
    public $level_id;
    public $level_role;

    public $querya;
    public $queryb;
    public $queryc;
    public $users;
    public $users2;
    public $users3;

    public $approver1;
    public $approver2;
    public $approver3;

    public $role1;
    public $role2;
    public $role3;

    public function mount(){
        $this->querya = '';
        $this->queryb = '';
        $this->queryc = '';
        $this->users = [];
    }

    public function updatedQuerya(){
        $this->users = User::select('id','name')
        ->where('name','like','%'.$this->querya. '%')
        ->get()->toArray();
    }

    public function updatedQueryb(){
        $this->users2 = User::select('id','name')
        ->where('name','like','%'.$this->queryb. '%')
        ->get()->toArray();
    }

    public function updatedQueryc(){
        $this->users3 = User::select('id','name')
        ->where('name','like','%'.$this->queryb. '%')
        ->get()->toArray();
    }

    public function selectUser1($id){
        $user = User::find($id);
        $this->users = [];
        $this->querya = $user->name;
        $this->approver1 = $id;

    }

    public function selectUser2($id){
        $user = User::find($id);
        $this->users2 = [];
        $this->queryb = $user->name;
        $this->approver2 = $id;

    }
    public function selectUser3($id){
        $user = User::find($id);
        $this->users3 = [];
        $this->queryc = $user->name;
        $this->approver3 = $id;

    }

    public function finish(){
        $level = Level::create([
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'max_value' => $this->max_value,
            'group_id' => session('group-id')
        ]);


        if($this->approver1){
            $level->approvers()->attach($this->approver1,[
                'level_role' => $this->role1,
            ]);
        }

        if($this->approver2){
            $level->approvers()->attach($this->approver2,[
                'level_role' => $this->role2,
            ]);
        }

        if($this->approver3){
            $level->approvers()->attach($this->approver3,[
                'level_role' => $this->role3,
            ]);
        }

        session()->flash('message', 'Level data saved successfully');
    }

    public function render()
    {
        return view('livewire.apps.approvals.create-levels');
    }
}
