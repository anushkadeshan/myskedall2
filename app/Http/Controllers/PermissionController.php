<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Controllers\HomeController;

class PermissionController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;
    private $roleRepository;
    
    public function __construct(PermissionRepository $permissionRepo, RoleRepository $roleRepo)
    {
        $this->permissionRepository = $permissionRepo;
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Permission.
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

        $permissions = $this->permissionRepository->paginate(10);
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('permissions.index')
            ->with([
                    'permissions'=>$permissions,
                    'roles' => $roles,
                    'userGroup' => $userGroup,
                    'activeGroup' => $activeGroup,
                    'defaultGroup' => $defaultGroup,
                    'groupData' => $groupData,
                ]);
    }

    /**
     * Show the form for creating a new Permission.
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

        return view('permissions.create')
            ->with([
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);
        
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
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
        
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')
            ->with([
                'permission' => $permission,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);
    }

    /**
     * Show the form for editing the specified Permission.
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

        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }
        return view('permissions.edit')
            ->with([
                'permission' => $permission,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);

    }

    /**
     * Update the specified Permission in storage.
     *
     * @param int $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');

        return redirect(route('permissions.index'));
    }

    public function givePermissionToRole(Request $req)
    {
        
        $permission = $this->permissionRepository->find($req->permission_id);

        if(is_null($req->roles)){
            $roles = Role::all()->pluck('id');
        }
        else{
            $roles = array_values($req->roles);
        }

        $permission->syncRoles($roles);
   
        Flash::success('Permission added to Roles successfully.');
        return redirect(route('permissions.index'));

    }
}
