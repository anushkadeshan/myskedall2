<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use DB;

class CreateTypes extends Component
{
    public $description;
    public $type;

    public $type_id;
    public $description_sub;
    public $sub_type;

    public function save(){
        $this->validate([
            'type' => 'required',
            'description' => 'required',
        ]);
        DB::table('request_types')->insert(
            [
                'type' => $this->type,
                'description' => $this->description,
                'group_id' => session('group-id')
            ]
        );

        $this->description = '';
        $this->type = '';

        $this->emit('refreshLivewireDatatable');

        session()->flash('message', 'added');
    }

    public function saveSub(){
        $this->validate([
            'sub_type' => 'required',
            'description_sub' => 'required',
        ]);
        DB::table('request_subtypes')->insert(
            [
                'sub_type' => $this->sub_type,
                'description' => $this->description_sub,
                'type_id' => $this->type_id,
                'group_id' => session('group-id')
            ]
        );
        session()->flash('message1', 'added');
    }

    public function render()
    {
        $types = DB::table('request_types')->where('group_id',session('group-id'))->get();
       // dd($types);
        return view('livewire.apps.approvals.create-types')->with(['types' => $types]);
    }
}
