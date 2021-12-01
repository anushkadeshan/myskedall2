<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Request;
use Illuminate\Support\Facades\DB;

class RequestsMultipleActions extends Component
{
    protected $listeners = ['selected'];
    public $values;
    public $max_sum = 0;
    public $value_sum = 0;

    public function selected($values){
        $this->values = $values;


        $requests = DB::table('requests')
            ->join('levels','levels.id','=','requests.level')
            ->whereIn('requests.id',$this->values)
            ->get();
        $this->value_sum = $requests->sum('total_value');
        $max_sum = $requests->sum('max_value');
        $this->max_sum = $max_sum;
    }

    public function repproved(){
        Request::whereIn('id', $this->values)->update(['current_status'=>2, 'color' => '#ef5350']);
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'Records Repproved');
    }

    public function approved(){
        Request::whereIn('id', $this->values)->update(['current_status'=>1, 'color' => '#66bb6a']);
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'Records Approved');
    }

    public function delete(){
        Request::whereIn('id', $this->values)->delete();
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'Records Deleted');
    }

    public function render()
    {
        return view('livewire.apps.approvals.requests-multiple-actions');
    }
}
