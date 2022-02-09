<?php

namespace App\Http\Controllers;

use Flash;
use App\User;
use Response;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\HomeController;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
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

        $roles = $this->roleRepository->all();

        return view('roles.index')
            ->with(['roles'=> $roles,
                    'userGroup' => $userGroup,
                    'activeGroup' => $activeGroup,
                    'defaultGroup' => $defaultGroup,
                    'groupData' => $groupData,
                ]);
    }

    /**
     * Show the form for creating a new Role.
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

        return view('roles.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        toast(trans('msg.Role saved successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            toast(trans('msg.Role not found.'),'error','top-right')->showCloseButton();

            return redirect(route('roles.index'));
        }
        
        return view('roles.show')->with([
            'role' => $role,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            toast(trans('msg.Role not found.'),'error','top-right')->showCloseButton();
            return redirect(route('roles.index'));
        }

        return view('roles.edit')->with([
            'role' => $role,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            toast(trans('msg.Role not found.'),'error','top-right')->showCloseButton();

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        toast(trans('msg.Role updated successfully.'),'success','top-right')->showCloseButton();

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            toast(trans('msg.Role not found.'),'error','top-right')->showCloseButton();

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        toast(trans('msg.Role deleted successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('roles.index'));
    }

    public function changeRole(Request $request)
    {
        
        $user = User::find($request->user);
        $user->syncRoles($request->role);
        toast(trans('msg.Role Assigned successfully.'),'success','top-right')->showCloseButton();
        return response()->json(200);
    }
}
