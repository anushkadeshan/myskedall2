<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;

class Filters extends Component
{
    public $status;
    public $d_start_date;
    public $d_end_date;
    public $l_start_date;
    public $l_end_date;

    public function filter(){
       // dd($this->status);
        $this->emit('filter',$this->status, $this->d_start_date, $this->d_end_date, $this->l_start_date, $this->l_end_date);
    }

    public function render()
    {
        return view('livewire.apps.approvals.filters');
    }
}
