<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Functionn;
use Illuminate\Http\Request;
use App\Repositories\FunctionRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateFunctionRequest;
use App\Http\Requests\UpdateFunctionRequest;

class FunctionController extends AppBaseController
{
    /** @var  FunctionRepository */
    private $functionRepository;

    public function __construct(FunctionRepository $functionRepo)
    {
        $this->functionRepository = $functionRepo;
    }

    /**
     * Display a listing of the Function.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $functions = Functionn::with('group')->where('group_id',session('group-id'))->get();
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('functions.index')
            ->with([
                'functions'=> $functions,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);
    }

    /**
     * Show the form for creating a new Function.
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

        return view('functions.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created Function in storage.
     *
     * @param CreateFunctionRequest $request
     *
     * @return Response
     */
    public function store(CreateFunctionRequest $request)
    {
        $input = $request->all();

        $function = $this->functionRepository->create($input);

        Flash::success('Function saved successfully.');

        return redirect(route('functions.index'));
    }

    /**
     * Display the specified Function.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $function = $this->functionRepository->find($id);

        if (empty($function)) {
            Flash::error('Function not found');

            return redirect(route('functions.index'));
        }

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('functions.show')->with([
            'function'=> $function,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified Function.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $function = $this->functionRepository->find($id);

        if (empty($function)) {
            Flash::error('Function not found');

            return redirect(route('functions.index'));
        }
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('functions.edit')->with([
            'function'=> $function,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified Function in storage.
     *
     * @param int $id
     * @param UpdateFunctionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFunctionRequest $request)
    {
        $function = $this->functionRepository->find($id);

        if (empty($function)) {
            Flash::error('Function not found');

            return redirect(route('functions.index'));
        }

        $function = $this->functionRepository->update($request->all(), $id);

        Flash::success('Function updated successfully.');

        return redirect(route('functions.index'));
    }

    /**
     * Remove the specified Function from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $function = $this->functionRepository->find($id);

        if (empty($function)) {
            Flash::error('Function not found');

            return redirect(route('functions.index'));
        }

        $this->functionRepository->delete($id);

        toast(trans('msg.Function deleted successfully.'),'success','top-right')->showCloseButton();

        return redirect(route('functions.index'));
    }
}
