<?php

namespace App\Http\Livewire\Materials;

use Livewire\Component;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;
    public $material;
    public $quantity;
    public $group_id;

    protected $listeners = ['edit' => 'edit'];
    //public $groups = [];

    public function mount(){
       // $this->groups = DB::table('groups')->select('name','id')->get();
        //dd($this->groups);
    }
    public function save(){
        $this->validate([
            'material' => 'required',
            'quantity' => 'required',
            'group_id' => 'required',
        ]);
        
        Material::create([
            'material' => $this->material,
            'quantity' => $this->quantity,
            'group_id' => $this->group_id,
        ]);

        $this->material = '';
        $this->quantity = '';
        $this->quantity = '';
        $this->closeModal();
        $this->emit('reloadTable');
        $this->alert('success', trans('msg.Material saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
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
        return view('livewire.materials.form')->with('groups', $groups);
    }
}
