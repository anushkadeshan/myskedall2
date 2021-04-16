<?php

namespace App\Http\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(){
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('reports.menu')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    public function locations(){
       
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $total_allocated = null;
        $total_available =null;
        $total_rejected = null;

        return view('reports.locations')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => $total_allocated,
            'total_available' => $total_available,
            'total_rejected' => $total_rejected,
            'initial_date' => null,
            'initial_time' => null,
            'final_date' => null,
            'final_time' => null,
        ]);
    }

	public function postLocations(Request $request)
	{
        
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;
        $total_allocated = DB::select(DB::raw(
            "SELECT count(DISTINCT(location)) as location_count FROM space_requests WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
       
        //dd($total_allocated[0]->location_count);
        $total_available = DB::select(DB::raw(
            "SELECT count(DISTINCT(location)) as location_count FROM space_requests WHERE `status`='0' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $total_rejected = DB::select(DB::raw(
            "SELECT count(DISTINCT(location)) as location_count FROM space_requests WHERE `status`='1' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
       
       // dd($total_available);
        //dd($request->all(),count($reservation));
        return view('reports.locations')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => $total_allocated[0]->location_count,
            'total_available' => $total_available[0]->location_count ,
            'total_rejected' => $total_rejected[0]->location_count,
            'initial_date' => $request->initial_date,
            'initial_time' => $request->initial_time,
            'final_date' => $request->final_date,
            'final_time' => $request->final_time,
        ]);
    }

    public function items()
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_items = 0;
        $total_allocated = 0;
        $total_available = 0;

        return view('reports.items')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_items' => $total_items,
            'total_allocated' => $total_allocated,
            'total_available' => $total_available,
            'initial_date' => null,
            'initial_time' => null,
            'final_date' => null,
            'final_time' => null,
        ]);
    }

    public function postItems(Request $request)
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_items = DB::table('materials')->sum('quantity');
        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;
        $total_allocated = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $items=[];
        foreach($total_allocated as $item){
            $items[] = $item->id;
        }

        $total_allocated_sum = DB::table('requested_materials')->whereIn('request_id',$items)->sum('quantity');

       

        // dd($total_available);
        //dd($request->all(),count($reservation));
        return view('reports.items')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_items' => $total_items,
            'total_allocated' => $total_allocated_sum,
            'initial_date' => $request->initial_date,
            'initial_time' => $request->initial_time,
            'final_date' => $request->final_date,
            'final_time' => $request->final_time,
        ]);
    }

    public function functions()
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_items = 0;
        $total_allocated = 0;
        $total_available = 0;

        return view('reports.functions')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_items' => $total_items,
            'total_allocated' => $total_allocated,
            'total_available' => $total_available,
            'initial_date' => null,
            'initial_time' => null,
            'final_date' => null,
            'final_time' => null,
        ]);
    }

    public function postFunctions(Request $request)
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_items = DB::table('functions')->sum('quantity');
        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;
        $total_allocated = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $items = [];
        foreach ($total_allocated as $item) {
            $items[] = $item->id;
        }

        $total_allocated_sum = DB::table('requested_functions')->whereIn('request_id', $items)->sum('quantity');

        // dd($total_available);
        //dd($request->all(),count($reservation));
        return view('reports.functions')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_items' => $total_items,
            'total_allocated' => $total_allocated_sum,
            'initial_date' => $request->initial_date,
            'initial_time' => $request->initial_time,
            'final_date' => $request->final_date,
            'final_time' => $request->final_time,
        ]);
    }

    public function values()
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $total_allocated = null;
        $total_available = null;
        $total_rejected = null;

        return view('reports.values')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => $total_allocated,
            'total_available' => $total_available,
            'total_rejected' => $total_rejected,
            'initial_date' => null,
            'initial_time' => null,
            'final_date' => null,
            'final_time' => null,
        ]);
    }

    public function postValues(Request $request)
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;
        $total_allocated = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));

        $total_allocated_sum = 0;
        foreach($total_allocated as $item) {
            $total_allocated_sum += $item->price;
        }
        $total_available = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE `status`='0' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $total_available_sum = 0;
        foreach ($total_available as $item) {
            $total_available_sum += $item->price;
        }
        $total_rejected = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE `status`='1' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $total_rejected_sum = 0;
        foreach ($total_rejected as $item) {
            $total_rejected_sum += $item->price;
        }
        // dd($total_available);
        //dd($request->all(),count($reservation));
        return view('reports.values')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => $total_allocated_sum,
            'total_available' => $total_available_sum,
            'total_rejected' =>  $total_rejected_sum,
            'initial_date' => $request->initial_date,
            'initial_time' => $request->initial_time,
            'final_date' => $request->final_date,
            'final_time' => $request->final_time,
        ]);
    }

    public function requests()
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $total_allocated = null;
        $total_available = null;
        $total_rejected = null;

        return view('reports.requests')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => $total_allocated,
            'total_available' => $total_available,
            'total_rejected' => $total_rejected,
            'initial_date' => null,
            'initial_time' => null,
            'final_date' => null,
            'final_time' => null,
        ]);
    }

    public function postRequests(Request $request)
    {

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $total_location = DB::table('space_location')->count();
        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;
        $total_allocated = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $total_available = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE `status`='0' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
        $total_rejected = DB::select(DB::raw(
            "SELECT * FROM space_requests WHERE `status`='1' AND('" . $fromtime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' NOT BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) NOT BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));

        // dd($total_available);
        //dd($request->all(),count($reservation));
        return view('reports.requests')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'total_location' => $total_location,
            'total_allocated' => count($total_allocated),
            'total_available' => count($total_available),
            'total_rejected' => count($total_rejected),
            'initial_date' => $request->initial_date,
            'initial_time' => $request->initial_time,
            'final_date' => $request->final_date,
            'final_time' => $request->final_time,
        ]);
    }

    public function checklist(){
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        $space_return_checklist = DB::table('space_return_checklist')->get();
        $reservations = DB::table('space_reservations')
            ->where('user_id',Auth::user()->id)
            ->where('final_date' ,'<', now())
            ->get();
        //dd($reservations);
        return view('reports.checklist')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'reservations' => $reservations,
            'location_returned_checklist' => null,
            'materials_returned_checklist' => null
        ]);
    }

	public function checklistData(Request $request)
	{
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        $reservations = DB::table('space_reservations')->where('final_date', '<', now())->get();

        //dd($request->all());
        $location_returned_checklist = DB::table('return_check_list')
        ->join('space_return_checklist', 'space_return_checklist.id','=', 'return_check_list.check_list_id')
        ->where('request_id',$request->request_id)->get();

        $materials_returned_checklist = DB::table('requested_materials')
        ->join('materials', 'materials.id', '=', 'requested_materials.metarial_id')
        ->where('request_id', $request->request_id)->get();
        //dd($materials_returned_checklist);
        $space_return_checklist = DB::table('space_return_checklist')->get();
        if(count($location_returned_checklist)==0){
            $location_returned_checklist = null;
        }

        return view('reports.checklist')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'reservations' => $reservations,
            'location_returned_checklist' => $location_returned_checklist,
            'space_return_checklist' => $space_return_checklist,
            'materials_returned_checklist'=> $materials_returned_checklist
        ]);
        
	}

	public function updateLocationchecklistData(Request $request)
	{
        //dd($request->all());
        if ($request->checklist) {
            $ids = DB::table('return_check_list')->whereNotIn('check_list_id', $request->checklist)->where('request_id', $request->request_id)->pluck('check_list_id');
          //  dd($ids,$request->all());
            $update = DB::table('return_check_list')->whereIn('check_list_id', $request->checklist)
            ->where('request_id', $request->request_id)
            ->update(['returned' => 1]);
            // dd($update);

            $update2 = DB::table('return_check_list')->whereIn('check_list_id', $ids)
            ->where('request_id', $request->request_id)
            ->update(['returned' => 0]);
        } else {
            $update = DB::table('return_check_list')
            ->where('request_id', $request->request_id)
            ->update(['returned' => 0]);
        }

        Flash::success('Checklist updated successfully.');
        return redirect()->back()->withInput();
	}

	public function updateLocationchecklistReason(Request $request)
	{
        DB::table('return_check_list')
            ->where('check_list_id', $request->check_id)
            ->where('request_id', $request->req_id)
            ->update(['reason'=>$request->reason]);

        return response()->json(['message'=>'success']);
    }


	public function updateMaterialChecklistData(Request $request)
	{
        //dd($request->all());
        if($request->checklistM){
        $ids = DB::table('requested_materials')->whereNotIn('metarial_id', $request->checklistM)->where('request_id', $request->request_id)->pluck('metarial_id');
        //dd($ids);
        $update1 = DB::table('requested_materials')->whereIn('metarial_id', $request->checklistM)
            ->where('request_id', $request->request_id)
            ->update(['returned' => 1]);
            // dd($update);

        $update2 = DB::table('requested_materials')->whereIn('metarial_id', $ids)
            ->where('request_id', $request->request_id)
            ->update(['returned' => 0]);
        }
        else{
        $update = DB::table('requested_materials')
            ->where('request_id', $request->request_id)
            ->update(['returned' => 0]);
        }
        
        Flash::success('Checklist updated successfully.');
   
        
        return redirect()->back()->withInput();
	}

	public function updateMaterialchecklistReason(Request $request)
	{
        DB::table('requested_materials')
        ->where('metarial_id', $request->check_id)
            ->where('request_id', $request->req_id)
            ->update(['reason' => $request->reason]);

        return response()->json(['message' => 'success']);
    }

    public function audit()
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        $space_return_checklist = DB::table('space_return_checklist')->get();
        $reservations = DB::table('space_reservations')->where('final_date', '<', now())->get();
        //dd($reservations);
        return view('reports.audit')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'reservations' => $reservations,
            'location_returned_checklist' => null,
            'materials_returned_checklist' => null
        ]);
    }

	public function auditData(Request $request)
	{
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        $reservations = DB::table('space_reservations')->where('final_date', '<', now())->get();

        //dd($request->all());
        $location_returned_checklist = DB::table('return_check_list')
        ->join('space_return_checklist', 'space_return_checklist.id', '=', 'return_check_list.check_list_id')
        ->where('request_id', $request->request_id)->get();

        $materials_returned_checklist = DB::table('requested_materials')
        ->join('materials', 'materials.id', '=', 'requested_materials.metarial_id')
        ->where('request_id', $request->request_id)->get();
        //dd($materials_returned_checklist);
        $space_return_checklist = DB::table('space_return_checklist')->get();
        if (count($location_returned_checklist) == 0) {
            $location_returned_checklist = null;
        }

        return view('reports.audit')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'reservations' => $reservations,
            'location_returned_checklist' => $location_returned_checklist,
            'space_return_checklist' => $space_return_checklist,
            'materials_returned_checklist' => $materials_returned_checklist
        ]);
	}

	public function updateLocationAuditData(Request $request)
	{
       // dd($request->all());
        if ($request->auditL) {
            $ids = DB::table('return_check_list')->whereNotIn('check_list_id', $request->auditL)->where('request_id', $request->request_id)->pluck('check_list_id');
            //dd($ids, $request->all());
            $update = DB::table('return_check_list')->whereIn('check_list_id', $request->auditL)
                ->where('request_id', $request->request_id)
                ->update(['audited' => 1,'points'=>1]);
            // dd($update);
            $update2 = DB::table('return_check_list')->whereIn('audited', $ids)
                ->where('request_id', $request->request_id)
                ->update(['audited' => 0, 'points'=> -1]);
        } else {
            $update = DB::table('return_check_list')
            ->where('request_id', $request->request_id)
                ->update(['audited' => 0, 'points' => -1]);
        }

        Flash::success('Checklist updated successfully.');
        return redirect()->back()->withInput();
	}

	public function updateMaterialAuditData(Request $request)
	{
       // dd($request->all());
        if ($request->auditM) {
            $ids = DB::table('requested_materials')->whereNotIn('metarial_id', $request->auditM)->where('request_id', $request->request_id)->pluck('metarial_id');
            //dd($ids);
            $update1 = DB::table('requested_materials')->whereIn('metarial_id', $request->auditM)
                ->where('request_id', $request->request_id)
                ->update(['audited' => 1, 'points' => 1]);
            // dd($update);

            $update2 = DB::table('requested_materials')->whereIn('metarial_id', $ids)
                ->where('request_id', $request->request_id)
                ->update(['audited' => 0, 'points' => -1]);
        } else {
            $update = DB::table('requested_materials')
            ->where('request_id', $request->request_id)
                ->update(['audited' => 0, 'points' => -1]);
        }

        Flash::success('Checklist updated successfully.');


        return redirect()->back()->withInput();
	}

	public function backLog()
	{
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $backlogs = DB::table('space_reservations')
            ->where('final_date', '<', now())
            ->get();
        
            //dd($backlogs);
        return view('reports.backlog')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'backlogs' => $backlogs
        ]);
    }

    public function backLogPost(Request $request)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $fromtime = $request->initial_date . ' ' . $request->initial_time;
        $totime = $request->final_date . ' ' . $request->final_time;

        $backlogs = DB::select(DB::raw(
            "SELECT * FROM space_reservations WHERE('" . $fromtime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '" . $totime . "' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "'
					OR CONCAT(final_date,' ',final_time) BETWEEN '" . $fromtime . "' AND '" . $totime . "')"
        ));
       // dd($backlogs);
        return view('reports.backlog')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'backlogs' => $backlogs
        ]);
    }

	public function backLogItem($id)
	{
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $backlogs = DB::table('space_reservations')
            ->join('users','users.id','=','space_reservations.user_id')
            ->where('space_reservations.id', $id)
            ->first();
            
        $materials = DB::table('requested_materials')
            ->where('request_id', $backlogs->request_id)
            ->get();

        $locations = DB::table('return_check_list')
        ->where('request_id', $backlogs->request_id)
            ->get();

        return view('reports.backlog-item')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'backlog'=> $backlogs, 
            'materials' => $materials, 
            'locations'=> $locations

            ]
        );
	}

    
}