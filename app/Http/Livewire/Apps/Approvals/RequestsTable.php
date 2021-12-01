<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Request;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RequestsTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    protected $listners = ['refreshLivewireDatatable' => 'columns'];

    public function builder()
    {
        if(session('app_current_status')=='null'){
            return Request::query()->join('users','users.id','=','requests.requster_id')->join('levels','levels.id','=','requests.level')->where('requests.group_id',session('group-id'));
        }

        else{
            return Request::query()->join('users','users.id','=','requests.requster_id')->join('levels','levels.id','=','requests.level')->where('requests.group_id',session('group-id'))->where('current_status' ,session('app_current_status'));
        }

    }

    public function columns()
    {
        return [
            Column::checkbox(),
            NumberColumn::name('id')->searchable()
                ->label('ID'),
            DateColumn::name('created_at')->searchable()
                ->label('Date'),
            Column::name('title')->searchable(),
            Column::name('users.name')->label('Requester')->searchable(),
            Column::name('level')->searchable(),
            Column::name('total_value'),
            Column::name('levels.max_value'),
            DateColumn::name('limit_date')->filterable(),
            DateColumn::name('due_date')->filterable(),
            Column::callback(['current_status','is_draft'], function ($current_status,$is_draft) {
                return view('livewire.apps.approvals.requests-table', ['current_status' => $current_status,'is_draft' => $is_draft]);
            })->label('Current Status'),
            Column::callback(['id'], function ($id) {
                return view('livewire.apps.approvals.requests-actions', ['id' => $id]);
            })->label('Action')

        ];
    }

    public function updatedSelected(){
        $this->emit('selected', $this->selected);
    }

}
