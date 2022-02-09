<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;
use DB;
use Auth;
Use Flash;
class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('Reasons.index')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    public function dataTable(Request $request){
        if (auth()->user()->hasRole('Super Admin')) {
            $data = DB::table('space_reason')->select('space_reason.*', 'users.name')
            ->join('users', 'users.id', '=', 'space_reason.user_id')
            ->where('group_id', session('group-id'));
        } else {
            $data = DB::table('space_reason')->select('space_reason.*', 'users.name')
            ->join('users', 'users.id', '=', 'space_reason.user_id')
            ->where('group_id', session('group-id'));
        }

        if (!empty($request->get('search')['value'])) {
            $search = $request->get('search')['value'];
            $data = $data->where('space_reason.reason', 'LIKE', '%' . $search . '%');
            $data = $data->oWhere('users.name', 'LIKE', '%' . $search . '%');
        }
        $count = $data->count();
        $data = $data->offset($request->get('start'))->take(7)->get();
        return response()->json(['draw' => $request->draw, 'aaData' => $data, 'recordsTotal' => $count, 'recordsFiltered' => $count], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
       
        return view('Reasons.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $set_data = [];
        $set_data['reason'] = $request->reason;
        $set_data['user_id'] = Auth::user()->id;
        $set_data['group_id'] = session('group-id');
        $set_data['updated_at'] = date('Y-m-d H:i:s');
        $set_data['created_at'] = date('Y-m-d H:i:s');
        if (DB::table('space_reason')->insertGetId($set_data)) {
            toast(trans('msg.Reason created Successfully.'),'success','top-right')->showCloseButton();
            return redirect('admin/space-reasons');
        } else {
            toast(trans('msg.Opps! Something Went Wrong'),'error','top-right')->showCloseButton();
            return back()->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        
        $reason = DB::table('space_reason')->find($id);
        return view('Reasons.edit')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'reason'=> $reason
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $set_data = [];
        $set_data['reason'] = $request->reason;
        $set_data['user_id'] = Auth::user()->id;
        $set_data['group_id'] = session('group-id');
        $set_data['updated_at'] = date('Y-m-d H:i:s');
        if (DB::table('space_reason')->where('id',$id)->update($set_data)) {
            toast(trans('msg.Reason Updated Successfully.'),'success','top-right')->showCloseButton();
            return redirect('admin/space-reasons');
        } else {
            toast(trans('msg.Opps! Something Went Wrong'),'error','top-right')->showCloseButton();
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        //
    }
}
