<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Flash;
class LocationTypeController extends Controller
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

        return view('location-types.index')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    public function dataTable(Request $request){
        $data = DB::table('space_location_type');
        if (!empty($request->get('search')['value'])) {
            $search = $request->get('search')['value'];
            $data = $data->where('location_type', 'LIKE', '%' . $search . '%');
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

        return view('location-types.create')->with([
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
        $set_data['location_type'] = $request->location_type;
        $set_data['created_at'] = date('Y-m-d H:i:s');
        if (DB::table('space_location_type')->insertGetId($set_data)) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                Flash::success('Tipo de localidade adicionado com sucesso');
            } else {
                Flash::success('Location Type Added Successfully.');
            }
            return redirect('admin/location-types');
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                Flash::error('Opps! Algo deu errado');
            } else {
                Flash::error('Opps! Something Went Wrong.');
            }
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $data = DB::table('space_location_type')->find($id);
        return view('location-types.edit')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $set_data = [];
        $set_data['location_type'] = $request->location_type;
        if (!empty($id)) {
            $set_data['updated_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_location_type')->where(['id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    Flash::success('Tipo de localidade enviado com sucesso');
                } else {
                    Flash::success('Location Type Updated Successfully');
                } 
                return redirect('admin/location-types');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    Flash::error('Opps! Algo deu errado');
                } else {
                    Flash::error('Opps! Something Went Wrong.');
                }
                return back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
