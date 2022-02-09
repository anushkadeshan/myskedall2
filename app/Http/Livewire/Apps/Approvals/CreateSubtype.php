<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CreateSubtype extends Component
{
    public $type_id;
    public $description_sub;
    public $sub_type;

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
        $this->emit('refreshLivewireDatatable');
        session()->flash('message1', 'added');

        $this->type_id = '';
        $this->description_sub = '';
        $this->sub_type = '';
    }

    public function render()
    {
        $types = DB::table('request_types')->where('group_id',session('group-id'))->get();
        return view('livewire.apps.approvals.create-subtype')->with(['types' => $types]);
    }
}
