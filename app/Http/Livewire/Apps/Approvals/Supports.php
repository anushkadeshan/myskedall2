<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\Models\Approvals\Support;
use Livewire\Component;

class Supports extends Component
{
    public $message;
    public $support;

    public function send(){
        Support::create([
            'support' => $this->support,
            'message' => $this->message,
            'added_by' => auth()->user()->id,
            'group_id' => session('group-id')
        ]);
        $this->support = '';
        $this->message = '';

        $this->alert('success', trans('msg.Support Saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.apps.approvals.supports');
    }
}
