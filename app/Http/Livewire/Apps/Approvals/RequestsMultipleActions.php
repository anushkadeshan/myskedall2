<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Request;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RequestsMultipleActions extends Component
{
    use LivewireAlert;
    protected $listeners = ['selected'];
    public $values;
    public $max_sum = 0;
    public $value_sum = 0;

    public function mount(){
        $requests = DB::table('requests')
            ->where('current_status',1)
            ->where('group_id', session('group-id'))
            ->get();

    $this->value_sum = $requests->sum('total_value');
    }

    public function selected($values){
        $this->values = $values;
       // $this->value_sum = $requests->sum('total_value');
        //$max_sum = $requests->sum('max_value');
        //$this->max_sum = $max_sum;
    }

    public function repproved(){
        Request::whereIn('id', $this->values)->update(['current_status'=>2, 'color' => '#ef5350']);
        $this->emit('refreshLivewireDatatable');
        $this->alert('success', trans('msg.Records Repproved.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        $this->mount();
    }

    public function approved(){
        Request::whereIn('id', $this->values)->update(['current_status'=>1, 'color' => '#66bb6a']);
        $this->emit('refreshLivewireDatatable');
        $this->alert('success', trans('msg.Records Approved'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        $this->mount();
    }

    public function delete(){
        Request::whereIn('id', $this->values)->delete();
        $this->emit('refreshLivewireDatatable');
        $this->alert('success', trans('msg.Records Deleted'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.apps.approvals.requests-multiple-actions');
    }
}
