<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\Event;
use App\Models\Approvals\Request;
use Livewire\Component;

class Calender extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Request::select('id','title','due_date as start', 'limit_date as end','color','url')->where('group_id',session('group-id'))->get();

        return  json_encode($events);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function eventDrop($event, $oldEvent)
    {
      $eventdata = Event::find($event['id']);
      $eventdata->start = $event['start'];
      $eventdata->save();
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {
        $events = Request::select('id','title','due_date as start', 'limit_date as end','color','url')->where('group_id',session('group-id'))->get();

        $this->events = json_encode($events);

        return view('livewire.apps.approvals.calender');
    }

}
