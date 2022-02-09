<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Type;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TypesTable extends LivewireDatatable
{
    public $exportable = true;
    protected $listners = ['refreshLivewireDatatable' => 'columns'];

    public function builder()
    {
        return Type::query()->where('request_types.group_id',session('group-id'));
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->searchable()
                ->label('ID'),
            Column::name('type')->searchable(),
            Column::name('description')
        ];
    }
    //public function render()
    //{
    //    return view('livewire.apps.approvals.types-table');
    //}
}
