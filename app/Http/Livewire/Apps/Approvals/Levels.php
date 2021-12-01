<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\User;
use Livewire\Component;
use App\Models\Approvals\Level;
use Illuminate\Support\Facades\DB;

class Levels extends Component
{
    public $levels;
    public $name;
    public $type;
    public $description;
    public $max_value;
    public $level_id;

    public $search;
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
    public $roleEdit;

    public $levelApprovers = [];

    public function updatedSearch(){
        $this->levels = Level::with('approvers')
        ->where('name','like','%'.$this->search. '%')
        ->get()->toArray();


    }

    public function mount(){
        $this->levels = Level::with('approvers')->where('group_id', session('group-id'))->get()->toArray();
        $this->querya = '';
        $this->queryb = '';
        $this->queryc = '';
        $this->search = '';
        $this->users = [];


        //dd($this->levels);
    }

    public function updatedQuerya(){
        $this->users = User::select('id','name')
        ->where('name','like','%'.$this->querya. '%')
        ->get()->toArray();

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();
    }

    public function updatedQueryb(){
        $this->users2 = User::select('id','name')
        ->where('name','like','%'.$this->queryb. '%')
        ->get()->toArray();

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();
    }

    public function updatedQueryc(){
        $this->users3 = User::select('id','name')
        ->where('name','like','%'.$this->queryb. '%')
        ->get()->toArray();

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();
    }

    public function selectUser1($id){
        $user = User::find($id);
        $this->users = [];
        $this->querya = $user->name;
        $this->approver1 = $id;

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();

    }

    public function updatedRoleEdit($value){
        preg_match_all('!\d+!', $value, $id);

        $role = preg_replace('/[^\\/\-a-z\s]/i', '', $value);

        DB::table('level_approvers')
                ->whereIn('id', $id)
                ->update(['level_role'=>$role]);

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();

    }

    public function selectUser2($id){
        $user = User::find($id);
        $this->users2 = [];
        $this->queryb = $user->name;
        $this->approver2 = $id;

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();

    }
    public function selectUser3($id){
        $user = User::find($id);
        $this->users3 = [];
        $this->queryc = $user->name;
        $this->approver3 = $id;

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();

    }

    public function deleteApprover($id){
        DB::table('level_approvers')->where('id',$id)->delete();
        $this->mount();

        session()->flash('message', 'Approver deleted successfully');
    }

    public function deleteLevel($id){
        DB::table('levels')->where('id',$id)->delete();
        $this->mount();

        session()->flash('message', 'Level deleted successfully');
    }

    function edit($id) {
        $this->name = '';
        $this->type = '';
        $this->description = '';
        $this->max_value = '';

        $level = Level::find($id);
        $this->name = $level->name;
        $this->type = $level->type;
        $this->description = $level->description;
        $this->max_value = $level->max_value;
        $this->level_id = $id;

        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $id)->get();

        $this->dispatchBrowserEvent('name-updated', ['newName' => $id]);
    }

    public function updated()
    {
        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();
    }

    public function update(){
        $this->levelApprovers = DB::table('level_approvers')
                ->join('users','users.id','=','level_approvers.aprrover_id')
                ->select('level_approvers.*','users.*','level_approvers.id as app_id')
                ->where('level_id', $this->level_id)->get();
        $level = Level::find($this->level_id);
        $level->name= $this->name;
        $level->type= $this->type;
        $level->description = $this->description;
        $level->max_value = $this->max_value;
        $level->save();

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
        $this->mount();
        $this->dispatchBrowserEvent('data-updated');
        session()->flash('message', 'Level data updated successfully');

    }

    public function render()
    {
        return view('livewire.apps.approvals.levels');
    }
}
