<?php

namespace App\Http\Livewire\Materials;

use Livewire\Component;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    public $material;
    public $quantity;
    public $allocated;
    public $group_id;
    public $mat_id;
    
    protected $listeners = ['reloadTable' => 'reloadTable'];
 
    public function reloadTable()
    {
        $this->render();
    }

    public function edit($id){
        $material = Material::find($id);
        $this->mat_id = $id;
        $this->material = $material->material;
        $this->quantity = $material->quantity;
        $this->allocated = $material->allocated;
        $this->group_id = $material->group_id;
        $this->openEditModal();
    }

    public function update(){
        if($this->quantity>$this->allocated){
            $material = Material::find($this->mat_id);
            $material->material = $this->material;
            $material->quantity = $this->quantity;
            $material->group_id = $this->group_id;
            $material->save();
            $this->closeEditModal();

            $this->alert('success', trans('msg.Material updated successfully.'), [
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 5000,
                'toast' => true,
            ]);
            $this->render();
        }
        else{
            $this->alert('error', trans('msg.Quantity should be more than allocated quantity.'), [
                'position' => 'center',
                'toast' => false
            ]);
        }
        
    }

    public function view($id){
        //dd("dsds");
        $material = Material::find($id);
        $this->mat_id = $id;
        $this->material = $material->material;
        $this->quantity = $material->quantity;
        $this->group_id = $material->group_id;
        $this->openViewModal();
    }

    public function openViewModal()
    {
        $this->dispatchBrowserEvent('openViewModal');
    }

    public function openEditModal()
    {
        $this->dispatchBrowserEvent('openEditModal');
    }
    public function closeEditModal()
    {
        $this->dispatchBrowserEvent('closeEditModal');
    }

    public function render()
    {
        
        $materials = Material::with('group')->where('group_id', session('group-id'))->get();
        $groups = DB::table('groups')->select('name','id')->get();
        return view('livewire.materials.table')->with(['materials' =>  $materials, 'groups' => $groups]);
    }
}
