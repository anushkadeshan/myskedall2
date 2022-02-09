<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Repositories\MaterialRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Material;
use Illuminate\Http\Request;
use Flash;
use Response;

class MaterialController extends AppBaseController
{
    /** @var  MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the Material.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $materials = Material::with('group')->where('group_id', session('group-id'))->get();
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('materials.index')
            ->with([
                'materials'=> $materials,
                'userGroup' => $userGroup,
                'activeGroup' => $activeGroup,
                'defaultGroup' => $defaultGroup,
                'groupData' => $groupData,
            ]);
    }

    /**
     * Show the form for creating a new Material.
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

        return view('materials.create')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Store a newly created Material in storage.
     *
     * @param CreateMaterialRequest $request
     *
     * @return Response
     */
    public function store(CreateMaterialRequest $request)
    {
        $input = $request->all();
        dd($input);
        $material = $this->materialRepository->create($input);

        toast(trans('msg.Material saved successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('materials.index'));
    }

    /**
     * Display the specified Material.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            toast(trans('msg.Material not found'),'error','top-right')->showCloseButton();
            return redirect(route('materials.index'));
        }

        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('materials.show')->with([
            'material'=> $material,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Show the form for editing the specified Material.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            toast(trans('msg.Material not found'),'error','top-right')->showCloseButton();

            return redirect(route('materials.index'));
        }
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();
        
        return view('materials.edit')->with([
            'material' => $material,
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Update the specified Material in storage.
     *
     * @param int $id
     * @param UpdateMaterialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaterialRequest $request)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            toast(trans('msg.Material not found'),'error','top-right')->showCloseButton();
            return redirect(route('materials.index'));
        }
        $material = $this->materialRepository->update($request->all(), $id);
        toast(trans('msg.Material updated successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('materials.index'));
    }

    /**
     * Remove the specified Material from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            toast(trans('msg.Material not found'),'error','top-right')->showCloseButton();

            return redirect(route('materials.index'));
        }

        $this->materialRepository->delete($id);
        toast(trans('msg.Material deleted successfully.'),'success','top-right')->showCloseButton();
        return redirect(route('materials.index'));
    }
}
