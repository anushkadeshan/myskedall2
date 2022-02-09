<?php

namespace App\Http\Livewire\Functions;

use App\Models\Functionn;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;
    public $professional;
    public $quantity;
    public $group_id;

    protected $listeners = ['edit' => 'edit'];

    public function save(){
        $this->validate([
            'professional' => 'required',
            'quantity' => 'required',
            'group_id' => 'required',
        ]);
        
        Functionn::create([
            'professional' => $this->professional,
            'quantity' => $this->quantity,
            'group_id' => $this->group_id,
        ]);

        $this->professional = '';
        $this->quantity = '';
        $this->group_id = '';
        $this->closeModal();
        $this->alert('success', trans('msg.Function saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        $this->emit('reloadFTable');
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openModal');
    }
    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        $groups = DB::table('groups')->select('name','id')->get();
        return view('livewire.functions.form')->with(['groups' => $groups]);
    }
}
