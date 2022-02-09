<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ApprovalRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;

class ApprovalController extends AppBaseController
{
    /** @var  ApprovalRepository */
    private $approvalRepository;

    public function __construct(ApprovalRepository $approvalRepo)
    {
        $this->approvalRepository = $approvalRepo;
    }

    /**
     * Display a listing of the Approval.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $approvals = $this->approvalRepository->all();

        return view('approvals.index')
            ->with([
                'approvals'=> $approvals,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);
    }

    public function approvals(Request $request){
        
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
       // dd($request->get('order'));
        $columnName_arr = $request->get('columns');
       // dd($columnIndex_arr);
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        //dd($columnName_arr);
        //$columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        $searchValue = $search_arr['value']; // Search value
        // Total records
        $totalRecords = Approval::select('count(*) as allcount')->where('group_id', session('group-id'))->count();
        $totalRecordswithFilter = Approval::select('count(*) as allcount')->where('events', 'like', '%' . $searchValue . '%')->where('group_id', session('group-id'))->count();

        $routine_filter = $columnName_arr[5]['search']['value'];
        $date_filter = $columnName_arr[1]['search']['value'];
        $requester_filter = $columnName_arr[2]['search']['value'];
        $event_filter = $columnName_arr[3]['search']['value'];
        $action_filter = $columnName_arr[7]['search']['value'];
        //dd($requester_filter);
        // Fetch records
        $fetch = Approval::where('space_requests.group_id', session('group-id'))
                ->join('space_location', 'space_location.id', '=', 'space_requests.location')
            //->orderBy('space_alerts.' . $columnName, $columnSortOrder)
            ->select(
                'space_requests.id as sp_id',
                'events',
                'reason',
                'space_location.name as location',
                'space_requests.status as status',
                'is_draft',
                'is_repproved',
                DB::raw('DATE(space_requests.initial_date) as initial_date')
            )
            ->where(function ($q) use ($searchValue) {
                $q->where('space_requests.events', 'like', '%' . $searchValue . '%');
                $q->orWhere('space_requests.reason', 'like', '%' . $searchValue . '%');
                $q->orWhere('space_requests.location', 'like', '%' . $searchValue . '%');
            })->skip($start)
            ->take($rowperpage);
        //dd($fetch);
        //if (isset($routine_filter)) {
        //    $fetch->where('space_alerts.routine', '=', $routine_filter);
        //}
//
        //if (isset($date_filter)) {
        //    $fetch->whereDate('space_alerts.created_at', '=', $date_filter);
        //}
        //if (isset($requester_filter)) {
        //    $fetch->where('space_alerts.user_id', '=', $requester_filter);
        //}
//
        //if (isset($event_filter)) {
        //    $fetch->where('space_alerts.event_name', '=', $event_filter);
        //}
//
        //if (isset($action_filter)) {
        //    $fetch->where('space_alerts.is_read', '=', $action_filter);
        //}


        $records =  $fetch
            ->latest('space_requests.created_at')->get();
       // dd($records);
        $data_arr = array();
        $sno = $start + 1;

        foreach ($records as $record) {
            $sp_id = $record->sp_id;
            $s_no = $sno++;
            $events = $record->events;
            $reason = $record->reason;
            $location = $record->location;
            $initial_date = $record->initial_date;
            $initial_time = $record->initial_time;
            $is_repproved = $record->is_repproved;
            $is_draft = $record->is_draft;
            $status = $record->status;

            $data_arr[] = array(
                "id" => $s_no,
                "events" => $events,
                "reason" => $reason,
                "location" => $location,
                "initial_date" => $initial_date,
                "initial_time" => $initial_time,
                "is_repproved" => $is_repproved,
                'is_draft' => $is_draft,
                'sp_id' => $sp_id,
                'status' => $status,
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
     * Show the form for creating a new Approval.
     *
     * @return Response
     */
    public function create()
    {
        return view('approvals.create');
    }

    /**
     * Store a newly created Approval in storage.
     *
     * @param CreateApprovalRequest $request
     *
     * @return Response
     */
    public function store(CreateApprovalRequest $request)
    {
        $input = $request->all();

        $approval = $this->approvalRepository->create($input);

        Flash::success('Approval saved successfully.');

        return redirect(route('approvals.index'));
    }

    /**
     * Display the specified Approval.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $approval = Approval::with('user','group','space_location')->find($id);
        //dd($approval);
        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('approvals.show')->with([
            'approval'=> $approval,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,    
        ]);
    }

    /**
     * Show the form for editing the specified Approval.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $approval = $this->approvalRepository->find($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('approvals.edit')->with([
            'approval'=> $approval,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified Approval in storage.
     *
     * @param int $id
     * @param UpdateApprovalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApprovalRequest $request)
    {
        $approval = $this->approvalRepository->find($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }

        $approval = $this->approvalRepository->update($request->all(), $id);

        Flash::success('Approval updated successfully.');

        return redirect(route('approvals.index'));
    }

    /**
     * Remove the specified Approval from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $approval = $this->approvalRepository->find($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }

        $this->approvalRepository->delete($id);

        Flash::success('Approval deleted successfully.');
        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Alert Deleted Successfully']);
        return redirect(route('approvals.index'));
    }

	public function rejectReason(Request $request)
	{
        $reservation = DB::table('space_reservations')->where('request_id', $request->request_id)->first();
        //dd($reservation);
        if($reservation){
            $reservation = DB::table('space_reservations')->where('request_id', $request->request_id)->delete();
        }
        $approval = $this->approvalRepository->find($request->request_id);
        $approval->reject_reason = $request->reason;
        $approval->status = 1;
        $approval->save();

        toast(trans('msg.Space request status changed successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('approvals.index'));

	}
}
