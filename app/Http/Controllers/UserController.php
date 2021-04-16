<?php

namespace App\Http\Controllers;

use Flash;
use App\User;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\HomeController;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo)
    {
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;

    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //$users = $this->userRepository->all();
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        if(Auth::user()->hasRole('Super Admin')){
            $users = User::with('groups', 'apps')->whereHas('groups', function ($query) {
                $query->where('group_id', session('group-id'));
                $query->groupBy('user_groups.user_id');
                return $query;
            })->paginate(10);
        }
        if(Auth::user()->hasRole(['Local Admin'])){
            
            $users = User::with('groups','apps')->whereHas('groups', function ($query) {
               // $groups = auth()->user()->groups()->withPivot('group_id')->pluck('group_id')->toArray();
                $admins = User::whereHas('roles', function ($query) {
                    return $query->where('name', '=', 'Super Admin');
                })->get()->pluck('id')->toArray();
                    //$query->whereIn('group_id', $groups);
                    $query->where('group_id', session('group-id'));
                    $query->whereNotIn('user_id', $admins);
                    $query->where('approved', true);
                    $query->groupBy('user_groups.user_id');
                    return $query;
            })->paginate(10);

        }
        if(Auth::user()->hasRole(['Module Admin'])) {
            
            $users = User::with('groups','apps')->whereHas('groups', function ($query) {
                //$groups = auth()->user()->groups()->withPivot('group_id')->pluck('group_id')->toArray();
                
                $admins = User::whereHas('roles', function ($query) {
                    return $query->whereIn('roles.name', ['Super Admin', 'Local Admin']);
                })->get()->pluck('id')->toArray();
               // $query->whereIn('group_id', $groups);
                $query->where('group_id', session('group-id'));
                $query->whereNotIn('user_id', $admins);
                $query->where('approved', true);
                $query->groupBy('user_groups.user_id');
                return $query;
            })->paginate(10);
        }

        $roles = $this->roleRepository->all();
        return view('users.index')
            ->with(['users'=> $users,
                    'roles'=>$roles, 
                    'userGroup' => $userGroup, 
                    'activeGroup'=> $activeGroup, 
                    'defaultGroup'=>$defaultGroup,
                    'groupData' => $groupData,
                ]);
    }

    /**
     * Show the form for creating a new User.
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

        return view('users.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        $input = $request->all();

        $user = User::create($input);

        $user->groups()->attach(1, ['approved' => 1]);
        $user->assignRole('User');
            
       // $user->apps()->attach(12);
        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with([
            'user' => $user,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with([
            'user' => $user,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
