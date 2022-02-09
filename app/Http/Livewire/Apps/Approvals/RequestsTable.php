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
    protected $listners = [
        'refreshLivewireDatatable' => 'columns',
    ];
    public $d_start_date;
    public $d_end_date;
    public $l_start_date;
    public $l_end_date;
    public $status;

    public function filterData($status,$d_start_date, $d_end_date,$l_start_date, $l_end_date){
        $this->d_start_date = $d_start_date;
        $this->d_end_date = $d_end_date;
        $this->l_start_date = $l_start_date;
        $this->l_end_date = $l_end_date;
        $this->status = $status;
    }

    public function builder()
    {
        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Module Admin')) {
            if(auth()->user()->approver->count() >0){
                if(session('app_current_status')=='null'){
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                            ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('requests.current_status',$this->status);
                        }
                        elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                
                        return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)]);
        
                        }
                        elseif(!is_null($this->status) && is_null($this->d_start_date) && is_null($this->d_end_date) ){
                            //dd("3",$this->status);
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->where('requests.current_status',$this->status);
                        }
        
                        else{
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'));
                        }
                }
                else{
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                    return Request::query()
                        ->join('users','users.id','=','requests.requster_id')
                        ->join('levels','levels.id','=','requests.level')
                        ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                        ->where('requests.group_id',session('group-id'))
                        ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                        ->where('requests.current_status',$this->status)
                        ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                        //dd("2");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(is_null($this->d_start_date || $this->d_end_date) && is_null(!$this->status)){
        
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('requests.current_status',$this->status)
                            ->where('current_status' ,session('app_current_status'));
                    }
        
                    else{
                        //dd("34",$this->status,session('app_current_status'));
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('current_status' ,session('app_current_status'));
                    }
        
                }
            }
            else{
                if(session('app_current_status')=='null'){
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('requests.current_status',$this->status);
                        }
                        elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                
                        return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.group_id',session('group-id'))
                                ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)]);
        
                        }
                        elseif(!is_null($this->status) && is_null($this->d_start_date) && is_null($this->d_end_date) ){
                            //dd("3",$this->status);
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.group_id',session('group-id'))
                                ->where('requests.current_status',$this->status);
                        }
        
                        else{
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.group_id',session('group-id'));
                        }
                }
                else{
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                    return Request::query()
                        ->join('users','users.id','=','requests.requster_id')
                        ->join('levels','levels.id','=','requests.level')
                        ->where('requests.group_id',session('group-id'))
                        ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                        ->where('requests.current_status',$this->status)
                        ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                        //dd("2");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(is_null($this->d_start_date || $this->d_end_date) && is_null(!$this->status)){
        
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.group_id',session('group-id'))
                            ->where('requests.current_status',$this->status)
                            ->where('current_status' ,session('app_current_status'));
                    }
        
                    else{
                        //dd("34",$this->status,session('app_current_status'));
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.group_id',session('group-id'))
                            ->where('current_status' ,session('app_current_status'));
                    }
        
                }
            }
        }else{
            if(auth()->user()->approver->count() >0){
                //dd(session('app_current_status'));
                if(session('app_current_status')=='null'){
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                            ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('requests.current_status',$this->status);
                        }
                        elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                
                        return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)]);

                        }
                        elseif(!is_null($this->status) && is_null($this->d_start_date) && is_null($this->d_end_date) ){
                            //dd("3",$this->status);
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->where('requests.current_status',$this->status);
                        }

                        else{
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->join('level_approvers','level_approvers.level_id','=','levels.id')
                                ->where('level_approvers.aprrover_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'));
                        }
                }
                else{
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                    return Request::query()
                        ->join('users','users.id','=','requests.requster_id')
                        ->join('levels','levels.id','=','requests.level')
                        ->join('level_approvers','level_approvers.level_id','=','levels.id')
                        ->where('level_approvers.aprrover_id',auth()->user()->id)
                        ->where('requests.group_id',session('group-id'))
                        ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                        ->where('requests.current_status',$this->status)
                        ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                        //dd("2");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                            ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(is_null($this->d_start_date || $this->d_end_date) && is_null(!$this->status)){

                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                            ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('requests.current_status',$this->status)
                            ->where('current_status' ,session('app_current_status'));
                    }

                    else{
                        //dd("34",$this->status,session('app_current_status'));
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->join('level_approvers','level_approvers.level_id','=','levels.id')
                            ->where('level_approvers.aprrover_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('current_status' ,session('app_current_status'));
                    }

                }
            }
            else{
                if(session('app_current_status')=='null'){
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.requster_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('requests.current_status',$this->status);
                        }
                        elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                
                        return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.requster_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)]);

                        }
                        elseif(!is_null($this->status) && is_null($this->d_start_date) && is_null($this->d_end_date) ){
                            //dd("3",$this->status);
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.requster_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'))
                                ->where('requests.current_status',$this->status);
                        }

                        else{
                            return Request::query()
                                ->join('users','users.id','=','requests.requster_id')
                                ->join('levels','levels.id','=','requests.level')
                                ->where('requests.requster_id',auth()->user()->id)
                                ->where('requests.group_id',session('group-id'));
                        }
                }
                else{
                    if(!is_null($this->d_start_date) && !is_null($this->d_end_date) && !is_null($this->status)){
                        //dd("1");
                    return Request::query()
                        ->join('users','users.id','=','requests.requster_id')
                        ->join('levels','levels.id','=','requests.level')
                        ->where('requests.group_id',session('group-id'))
                        ->where('requests.requster_id',auth()->user()->id)
                        ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                        ->where('requests.current_status',$this->status)
                        ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(!is_null($this->d_start_date) && !is_null($this->d_end_date) && is_null($this->status) ){
                        //dd("2");
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.requster_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->whereBetween('requests.due_date',[date($this->d_start_date), date($this->d_end_date)])
                            ->where('current_status' ,session('app_current_status'));
                    }
                    elseif(is_null($this->d_start_date || $this->d_end_date) && is_null(!$this->status)){

                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.requster_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('requests.current_status',$this->status)
                            ->where('current_status' ,session('app_current_status'));
                    }

                    else{
                        //dd("34",$this->status,session('app_current_status'));
                        return Request::query()
                            ->join('users','users.id','=','requests.requster_id')
                            ->join('levels','levels.id','=','requests.level')
                            ->where('requests.requster_id',auth()->user()->id)
                            ->where('requests.group_id',session('group-id'))
                            ->where('current_status' ,session('app_current_status'));
                    }

                }
            }
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
            Column::callback(['current_status','is_draft'], function ($current_status,$is_draft) {
                return view('livewire.apps.approvals.requests-table', ['current_status' => $current_status,'is_draft' => $is_draft]);
            })->label('Current Status'),
            Column::name('total_value'),
            Column::name('levels.max_value'),
            DateColumn::name('limit_date')->filterable(),
            DateColumn::name('due_date')->filterable(),
            Column::callback(['id'], function ($id) {
                return view('livewire.apps.approvals.requests-actions', ['id' => $id]);
            })->label('Action')

        ];
    }

    public function updatedSelected($value){
        $this->emit('selected', $this->selected);
    }

}
