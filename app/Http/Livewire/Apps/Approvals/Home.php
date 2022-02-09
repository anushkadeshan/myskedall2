<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Request;
use Illuminate\Support\Facades\DB;

class Home extends Component
{
    public $blue =0;
    public $green = 0;
    public $red = 0;
    public $yellow = 0;
    public $pink = 0;
    public $purple = 0;
    public $gray = 0;
    public $approver = false;
    public $blue_levels;
    public $green_levels;
    public $red_levels;
    public $yellow_levels;
    public $pink_levels;
    public $purple_levels;
    public $gray_levels;

    public function mount(){
        if(auth()->user()->approver->count() >0){
            $this->approver = true;
            $levels = auth()->user()->approver->pluck('id');
            //blue
            $this->blue = Request::whereNull('sean_by_user')->whereNotIn('current_status',[0])->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
            $this->blue_levels = DB::table('requests')
                ->join('levels', 'levels.id','=','requests.level')
                ->select('requests.sean_by_user', 'requests.current_status',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                ->whereNull('sean_by_user')
                ->whereNotIn('current_status',[0])
                ->whereIn('level',$levels)
                ->where('requests.group_id',session('group-id'))
                ->groupBy('levels.name')
                ->get();

            //greem
            $this->green = Request::where('current_status',1)->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
            $this->green_levels = DB::table('requests')
                ->join('levels', 'levels.id','=','requests.level')
                ->select('requests.sean_by_user', 'requests.current_status',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                ->where('current_status',1)
                ->whereIn('level',$levels)
                ->where('requests.group_id',session('group-id'))
                ->groupBy('levels.name')
                ->get();

            //red
            $this->red = Request::where('current_status',2)->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
            $this->red_levels = DB::table('requests')
                ->join('levels', 'levels.id','=','requests.level')
                ->select('requests.sean_by_user', 'requests.current_status',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                ->where('current_status',2)
                ->whereIn('level',$levels)
                ->where('requests.group_id',session('group-id'))
                ->groupBy('levels.name')
                ->get();

             //yellow
             $this->yellow = Request::where('current_status',0)->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
             $this->yellow_levels = DB::table('requests')
                 ->join('levels', 'levels.id','=','requests.level')
                 ->select('requests.sean_by_user', 'requests.current_status',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                 ->where('current_status',0)
                 ->where('requests.group_id',session('group-id'))
                 ->whereIn('level',$levels)
                 ->groupBy('levels.name')
                 ->get();



            //pink
            $this->pink = Request::where('is_draft',1)->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
            $this->pink_levels = DB::table('requests')
                ->join('levels', 'levels.id','=','requests.level')
                ->select('requests.sean_by_user', 'requests.is_draft',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                ->where('is_draft',1)
                ->where('requests.group_id',session('group-id'))
                ->whereIn('level',$levels)
                ->groupBy('levels.name')
                ->get();

            //purple
            $this->purple = Request::where('current_status',4)->whereIn('level',$levels)->where('requests.group_id',session('group-id'))->count();
            $this->purple_levels = DB::table('requests')
                ->join('levels', 'levels.id','=','requests.level')
                ->select('requests.sean_by_user', 'requests.current_status',  'requests.level','levels.name', DB::raw('count(levels.name) as count'))
                ->where('current_status',4)
                ->where('requests.group_id',session('group-id'))
                ->whereIn('level',$levels)
                ->groupBy('levels.name')
                ->get();

            
        }
        else{
            $this->blue = Request::whereNull('sean_by_user')->whereNotIn('current_status',[0])->where('requster_id',auth()->user()->id)->where('requests.group_id',session('group-id'))->count();
            $this->green = Request::where('current_status',1)->where('requster_id',auth()->user()->id)->where('group_id',session('requests.group-id'))->count();
            $this->red = Request::where('current_status',2)->where('requster_id',auth()->user()->id)->where('group_id',session('requests.group-id'))->count();
            $this->yellow = Request::where('current_status',0)->where('requster_id',auth()->user()->id)->where('group_id',session('requests.group-id'))->count();
            $this->pink = Request::where('is_draft',1)->where('requster_id',auth()->user()->id)->where('group_id',session('requests.group-id'))->count();
            $this->purple = Request::where('current_status',4)->where('requster_id',auth()->user()->id)->where('group_id',session('requests.group-id'))->count();
        }

    }

    public function render()
    {
        return view('livewire.apps.approvals.home');
    }
}
