<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;

class ViewRequest extends Component
{
    public $request;
    public function mount($request){
        $this->request = $request;
    }
    public function render()
    {
        return view('livewire.apps.approvals.view-request');
    }
}
