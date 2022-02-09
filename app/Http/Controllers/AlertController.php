<?php

namespace App\Http\Controllers;

use Flash;
use App\User;
use Response;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AlertRepository;
use App\Http\Controllers\HomeController;
use App\Http\Requests\CreateAlertRequest;
use App\Http\Requests\UpdateAlertRequest;
use App\Http\Controllers\AppBaseController;

class AlertController extends AppBaseController
{
    /** @var  AlertRepository */
    private $alertRepository;

    public function __construct(AlertRepository $alertRepo)
    {
        $this->alertRepository = $alertRepo;
    }

    /**
     * Display a listing of the Alert.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $routines = Alert::groupBy('routine')->where('group_id', session('group-id'))->pluck('routine');
        $data = Alert::with('user')->groupBy('user_id')->where('group_id', session('group-id'))->pluck('user_id');
        $requesters = User::whereIn('id',$data)->select('name','id')->get();
        //dd($requesters);
        $events = Alert::groupBy('event_name')->where('group_id', session('group-id'))->pluck('event_name');

        $result = Alert::select(DB::raw('Date(created_at) as dates'))->where('group_id', session('group-id'))->distinct()->get();
        $dates = $result->pluck('dates');
        $alerts = Alert::with('user','group')->where('group_id',session('group-id'))->paginate(10);
        $unread = Alert::where('is_read',0)->where('group_id', session('group-id'))->count();
        //dd($alerts);
        //dd($dates);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        
        return view('alerts.index')
            ->with([
                'routines' => $routines,
                'alerts'=> $alerts,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
                'dates' => $dates,
                'requesters' => $requesters,
                'events' => $events,
                'unread' => $unread
            ]);
    }

    public function alertData(Request $request)
    { //dd($request->all());
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');

        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        //dd($columnName_arr);
        //$columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        $searchValue = $search_arr['value']; // Search value
        // Total records
        $totalRecords = Alert::select('count(*) as allcount')->where('group_id', session('group-id'))->count();
        $totalRecordswithFilter = Alert::select('count(*) as allcount')->where('event_name', 'like', '%' . $searchValue . '%')->where('group_id', session('group-id'))->count();

        $routine_filter = $columnName_arr[5]['search']['value'];
        $date_filter = $columnName_arr[1]['search']['value'];
        $requester_filter = $columnName_arr[2]['search']['value'];
        $event_filter = $columnName_arr[3]['search']['value'];
        $action_filter = $columnName_arr[7]['search']['value'];
        //dd($requester_filter);
        // Fetch records
        $fetch = Alert::where('space_alerts.group_id', session('group-id'))
            //->orderBy('space_alerts.' . $columnName, $columnSortOrder)
            ->join('users', 'users.id', '=', 'space_alerts.user_id')
            ->join('groups', 'groups.id', '=', 'space_alerts.group_id')
            ->select('users.name as name', 'groups.name as group_name', 
            'space_alerts.id as sp_id', 'event_name', 'routine', 'is_read','is_read','url',
                DB::raw('DATE(space_alerts.created_at) as created_at'),'group_id','space_alerts.updated_at as updated_at','updated_by')
            ->where(function($q) use($searchValue){
                $q->where('space_alerts.routine', 'like', '%' . $searchValue . '%');
             $q->orWhere('space_alerts.event_name', 'like', '%' . $searchValue . '%');
             $q->orWhere('groups.name', 'like', '%' . $searchValue . '%');
             $q->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })->skip($start)
            ->take($rowperpage);
            //dd($fetch);
            if(isset($routine_filter)){
                $fetch->where('space_alerts.routine', '=', $routine_filter);
            }

            if(isset($date_filter)){
                $fetch->whereDate('space_alerts.created_at', '=', $date_filter);
            }
            if(isset($requester_filter)){
                $fetch->where('space_alerts.user_id', '=', $requester_filter);
            }

            if(isset($event_filter)){
                $fetch->where('space_alerts.event_name', '=', $event_filter);
            }

            if(isset($action_filter)){
                $fetch->where('space_alerts.is_read', '=', $action_filter);
            }
                
            
        $records =  $fetch
                    ->latest()->get();
        //dd($records);
        $data_arr = array();
        $sno = $start + 1;

        foreach ($records as $record) {
            $sp_id = $record->sp_id;
            $s_no = $sno++;
            $user_name = $record->name;
            $group_name = $record->group_name;
            $event_name = $record->event_name;
            $routine = $record->routine;
            $action = $record->is_read;
            $url = $record->url;
            $date = $record->created_at;
            $updated_at = $record->updated_at;
            $updated_by = $record->updated_by;

            $data_arr[] = array(
                "id" => $s_no,
                "user_name" => $user_name,
                "group_name" => $group_name,
                "event_name" => $event_name,
                "routine" => $routine,
                "action" => $action,
                "url" => $url,
                'date' => $date,
                'sp_id' => $sp_id,
                'updated_by' => $updated_by,
                'updated_at' => $updated_at,
            );
        }
        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
       
    }

    /**
     * Show the form for creating a new Alert.
     *
     * @return Response
     */
    public function create()
    {
        return view('alerts.create');
    }

    /**
     * Store a newly created Alert in storage.
     *
     * @param CreateAlertRequest $request
     *
     * @return Response
     */
    public function store(CreateAlertRequest $request)
    {
        $input = $request->all();

        $alert = $this->alertRepository->create($input);

        return redirect(route('alerts.index'));
    }

    /**
     * Display the specified Alert.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alert = Alert::with('group','user')->find($id);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        if (empty($alert)) {
            toast(trans('msg.Alert not found'),'error','top-right')->showCloseButton();

            return redirect(route('alerts.index'));
        }

        return view('alerts.show')->with([
            'alert'=> $alert,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified Alert.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alert = Alert::with('group', 'user')->find($id);
        //dd($alert);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        if (empty($alert)) {
            toast(trans('msg.Alert not found'),'error','top-right')->showCloseButton();

            return redirect(route('alerts.index'));
        }

        return view('alerts.edit')->with([
            'alert'=> $alert,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            ]);
    }

    /**
     * Update the specified Alert in storage.
     *
     * @param int $id
     * @param UpdateAlertRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlertRequest $request)
    {
        $alert = $this->alertRepository->find($id);

        if (empty($alert)) {
            toast(trans('msg.Alert not found'),'error','top-right')->showCloseButton();
            return redirect(route('alerts.index'));
        }

        $alert = $this->alertRepository->update($request->all(), $id);

        toast(trans('msg.Alert updated successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('alerts.index'));
    }

    public function changeAction(Request $req){
        $alert = $this->alertRepository->find($req->alert_id);
        $alert->is_read = $req->value;
        $alert->updated_by = Auth::user()->name;
        $alert->save();
        toast(trans('msg.Alert updated successfully.'),'success','top-right')->showCloseButton();


        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Alert updated Successfully']);
    }

    /**
     * Remove the specified Alert from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Request $req, $id)
    {
        if (auth()->user()->hasRole('Local Admin')) {
        $alert = $this->alertRepository->find($id);
        //dd($alert);
        if (empty($alert)) {
            toast(trans('msg.Alert not found'),'error','top-right')->showCloseButton();

            return redirect(route('alerts.index'));
        }

        $this->alertRepository->delete($id);
        toast(trans('msg.Alert Deleted successfully.'),'success','top-right')->showCloseButton();
        return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('msg.Alert Deleted successfully.')]);
        }
        else{
            toast(trans('msg.You do not have permissions to delete alert'),'error','top-right')->showCloseButton();
            return response()->json(['code' => 403, 'status' => 'error', 'message' => trans('msg.You do not have permissions to delete alert')]);
        }
    }
}
