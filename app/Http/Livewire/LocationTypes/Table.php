<?php

namespace App\Http\Livewire\LocationTypes;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;
    public $loc_id;
    public $location_type;


    protected $listeners = ['locationTypeSaved' => 'locationTypeSaved'];
    public function locationTypeSaved(){
        $this->alert('success', trans('msg.Location Type Added Successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        return redirect('admin/location-types');

        $this->render();
    }

    public function edit($id){
        $loc = DB::table('space_location_type')->where('id',$id)->first();
        $this->loc_id = $id;
        $this->location_type = $loc->location_type;
        $this->openEditModal();
    }

    public function update(){
        $loc = DB::table('space_location_type')->where('id',$this->loc_id)->update(['location_type' => $this->location_type]);
        $this->closeEditModal();
        $this->alert('success', trans('msg.Location Type Updated Successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        $this->render();
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
        $locations = DB::table('space_location_type')->get();
        return view('livewire.location-types.table')->with(['locations' => $locations]);
    }
}
