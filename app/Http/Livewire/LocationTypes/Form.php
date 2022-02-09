<?php

namespace App\Http\Livewire\LocationTypes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Form extends Component
{
    public $location_type;

    public function save(){
        $set_data = [];
        $set_data['location_type'] = $this->location_type;
        $set_data['created_at'] = date('Y-m-d H:i:s');
        if (DB::table('space_location_type')->insertGetId($set_data)) {
            $this->emit('locationTypeSaved');
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message','Opps! Algo deu errado');
            } else {
                session()->flash('message','Opps! Something Went Wrong.');
            }
            return back()->withInput();
        }
    }

    public function render()
    {
        return view('livewire.location-types.form');
    }
}
