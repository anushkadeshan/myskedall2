<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\Models\Approvals\SubType;
use Livewire\Component;
use App\Models\Approvals\Type;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class SubtypesTable extends LivewireDatatable
{
    public $exportable = true;
    protected $listners = ['refreshLivewireDatatable' => 'columns'];

    public function builder()
    {
        return SubType::query()->join('request_types','request_types.id','=','request_subtypes.type_id')->where('request_subtypes.group_id',session('group-id'));
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->searchable()
                ->label('ID'),
            Column::name('request_types.type')->label('Type')->searchable(),
            Column::name('sub_type')->searchable(),
            Column::name('description')
        ];
    }

    //public function render()
    //{
    //    return view('livewire.apps.approvals.subtypes-table');
    //}
}
