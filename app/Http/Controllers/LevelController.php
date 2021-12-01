<?php

namespace App\Http\Controllers;

use App\Model\Approvals\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
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

        return view('app-approvals.levels')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
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

        return view('app-approvals.create-levels')->with([
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Approvals\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Approvals\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Approvals\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Approvals\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        //
    }
}
