<?php

namespace App\Http\Controllers;

use Flash;
use App\App;
use App\User;
use Response;
use App\Group;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Http\Controllers\HomeController;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Controllers\AppBaseController;
use DB;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Group.
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

        $groups = $this->groupRepository->all();
        $apps = App::where('active',true)->get();
        $managers = User::where('level', true)->get();
        //dd($apps);
        return view('groups.index')
            ->with(['groups'=> $groups,
                    'apps'=>$apps,
                    'userGroup' => $userGroup,
                    'activeGroup' => $activeGroup,
                    'defaultGroup' => $defaultGroup,
                    'groupData' => $groupData,
                    'managers' => $managers
                ]);
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create()
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('groups.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $input = $request->all();

        $group = $this->groupRepository->create($input);

        $group_logo =$request->file('group_logo');
        $group_banner =$request->file('group_banner');

		$group_logo_name = 'logo.png';
		$group_banner_name = 'banner.jpg';

        $group_logo->move(public_path().'/_dados/plataforma/grupos/'.$group->id, $group_logo_name);
        $group_banner->move(public_path().'/_dados/plataforma/grupos/'.$group->id, $group_banner_name);

        $superAdmin = User::role('Super Admin')->first();

        $row =  DB::table('user_groups')->insert(['approved' => 1, 'approved_at' => now(), 'user_id'=> $superAdmin->id,'group_id'=> $group->id]);
                //dd($group->id,$superAdmin->id, $row);

        toast(trans('msg.Group saved successfully.'),'success','top-right')->showCloseButton();

        return redirect(route('groups.index'));
    }

    /**
     * Display the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->find($id);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        if (empty($group)) {
            toast(trans('msg.Group not found'),'error','top-right')->showCloseButton();
            return redirect(route('groups.index'));
        }

        return view('groups.show')->with([
            'group' => $group,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->groupRepository->find($id);

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        if (empty($group)) {
            toast(trans('msg.Group not found'),'error','top-right')->showCloseButton();

            return redirect(route('groups.index'));
        }

        return view('groups.edit')->with([
            'group' => $group,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified Group in storage.
     *
     * @param int $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            toast(trans('msg.Group not found'),'error','top-right')->showCloseButton();

            return redirect(route('groups.index'));
        }

        $group = $this->groupRepository->update($request->all(), $id);
        toast(trans('msg.Group updated successfully.'),'success','top-right')->showCloseButton();

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified Group from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            toast(trans('msg.Group not found'),'error','top-right')->showCloseButton();

            return redirect(route('groups.index'));
        }

        $this->groupRepository->delete($id);

        toast(trans('msg.Group deleted successfully.'),'success','top-right')->showCloseButton();

        return redirect(route('groups.index'));
    }

    public function groupRequests(){
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('groups.requests')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

	public function assignManagerstoGroup(Request $request)
	{
        $group = Group::find($request->group_id);
        //dd($group);
        if (is_null($request->managers)) {
            toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
            return redirect(route('groups.index'));
        } else {
            $managers = $request->managers;
            $insert = $group->managers()->sync($managers);
            if ($insert) {
                toast(trans('msg.Managers assigned to Group successfully.'),'success','top-right')->showCloseButton();

                return redirect(route('groups.index'));
            } else {
                toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                return redirect(route('groups.index'));
            }
        }
        // dd($apps);


	}
}
