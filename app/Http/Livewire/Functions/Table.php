<?php

namespace App\Http\Livewire\Functions;

use Livewire\Component;
use App\Models\Functionn;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    public $professional;
    public $quantity;
    public $group_id;
    public $allocated;
    public $f_id;
    
    protected $listeners = ['reloadFTable' => 'reloadFTable'];
    public function reloadFTable()
    {
        $this->render();
    }

    public function edit($id){
        $fun = Functionn::find($id);
        $this->f_id = $id;
        $this->professional = $fun->professional;
        $this->quantity = $fun->quantity;
        $this->allocated = $fun->allocated;
        $this->group_id = $fun->group_id;
        $this->openEditModal();
    }

    public function update(){
        if($this->quantity>$this->allocated){
            $fun = Functionn::find($this->f_id);
            // dd($fun);
             $fun->professional = $this->professional;
             $fun->quantity = $this->quantity;
             $fun->group_id = $this->group_id;
             $fun->save();
            $this->closeEditModal();

            $this->alert('success', trans('msg.Function Data updated successfully'), [
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
        $this->render();
        
    }

    public function view($id){
        //dd("dsds");
        $fun = Functionn::find($id);
        $this->professional = $fun->professional;
        $this->quantity = $fun->quantity;
        $this->group_id = $fun->group_id;
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
        $functions = Functionn::with('group')->where('group_id',session('group-id'))->get();
        $groups = DB::table('groups')->select('name','id')->get();
        return view('livewire.functions.table')->with(['functions' => $functions,'groups'=> $groups]);
    }
}
