<?php

namespace App\Http\Controllers;

use DB;
use App\App;
use App\User;
use App\Group;
use App\Location;
use App\SpaceRequests;
use App\Models\Material;
use App\Models\Functionn;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Space\NewRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Events\EventRequest;
use App\Http\Requests\Reason\ReasonRequest;
use Flash;

class HomeController extends Controller
{
    public function Index(Request $request)
    {
        $showLogin = true;
        if (session('user_id')) {
            $showLogin = false;
        }
        return view('web/home/index')->withShowLogin($showLogin);
    }
    public function Register(RegisterUser $request)
    {
        $set_data['name'] = $request->name;
        $set_data['email'] = $request->email;
        $set_data['phone'] = $request->phone;
        $set_data['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        $set_data['created_at'] = date('Y-m-d H:i:s');
        if (DB::table('users')->insertGetId($set_data)) {
            return redirect('login');
        } else {
            return redirect('');
        }
    }
    public function Home()
    {

        $groupData = $this->GetGroupList();

        $user = User::where('id', Auth::id())->first();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
       // dd($userGroup);
        $defaultGroup = $this->DefaultGroup();
        if(session('group-id')==null){
            $group = Group::find(1);
        }
        else{
            $group = Group::find(session('group-id'));
        }
       // dd(session('group-id'));

        if (session('locale') == 'pt'){
            $data = $group->apps()
                ->select('title_pt as title', 'description_pt as description', 'image','redirect_link', 'apps.id as app_id')
                ->where('active', true)
                ->get();
        }
        else{
            $data = $group->apps()
                ->select('title_en as title', 'description_en as description','image','redirect_link', 'apps.id as app_id')
                ->where('active', true)
                ->get();
            //dd($data);
        }

        if (session('SuperAdmin') == 1) {
            $alert = DB::table('space_alerts')->where(['is_read' => 0])->count();
        } else {
            $alert = DB::table('space_alerts')->where(['is_read' => 0])->where('group_id', session('group-id'))->count();
        }
        //dd($data,session('user_id'));
        $HomeControllrt = new HomeController;
        $userGroup = $HomeControllrt->UserGroup();
        $activeGroup = $HomeControllrt->ActiveGroup();
        $defaultGroup = $HomeControllrt->DefaultGroup();
        $groupData = $HomeControllrt->GetGroupList();

        return view('dashboard.index')->with([
            'userGroup' => $userGroup,
            'activeGroup' => $activeGroup,
            'defaultGroup' => $defaultGroup,
            'groupData' => $groupData,
            'data' => $data,
            'user' => $user,
            'spaceAlert' => $alert

        ]);
        //return view('platform/home/index')->withData($data)
        //    ->withUser($user)->withGroupData($groupData)
        //    ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
        //    ->withUserGroup($userGroup)->withSpaceAlert($alert);
    }
    public function Apps()
    {
        $group_id = session('group-id');
        $user = User::where('id', auth()->user()->id)->first();
        $apps = $this->ActiveGroup();

        $data = App::all();

        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        return view('platform/apps/index')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
    }
    public function GetGroupList()
    {
        $other_groups = auth()->user()->groups()->get()->pluck('id');

        $other_groups = $other_groups->toArray();

        return Group::whereNotIn('id', $other_groups)->get();
    }
    public function AppPermission(Request $request, $key, $value)
    {
        $update = App::where('app_key', $key)->update(['active'=>$value]);
        if($update){
            return redirect('/apps');
        }

    }
    public function ActiveGroup()
    {
        if(session('group-id')==null){
            $group_id = 1;
        }
        else{
            $group_id = session('group-id');
        }

        return Group::where('id', $group_id)->first();
    }
    public function DefaultGroup()
    {
        return DB::table('groups')->select('groups.name', 'users.primary_group_id')
            ->join('users', 'users.primary_group_id', '=', 'groups.id')
            ->where(['users.id' => session('user_id')])->first();
    }
    public function ChangeActiveGroup($group_id)
    {
        session(['group-id' => $group_id]);
        return redirect()->back();
    }
    public function UserGroup()
    {
        //Group::with('users')->get()->dd();
        return Group::whereHas('users', function ($query) {
            return $query->where(['user_id'=> Auth::id(), 'approved'=> 1]);
        })->get();
    }

    public function JoinedGroups()
    {
        $other_groups = auth()->user()->groups()->get()->pluck('id');
        $other_groups = $other_groups->toArray();
        return Group::whereNotIn('id', $other_groups)->get();
    }
    public function AdminSpaceRequest()
    {
        $group_id = session('group-id');
        $user = User::where('id', session('user_id'))->first();
        $apps = $this->ActiveGroup();

        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();

        return view('platform/admin/space/index')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminSpaceRequest')->withAddress(null);
    }
    public function AdminEditSpaceRequest($id)
    {
        $group_id = session('group-id');
        $user = Auth::user();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        $request = SpaceRequests::find($id);
        return view('platform/admin/space/edit')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withData($request);
    }
    public function AdminPostSpaceRequest(Request $request, $id)
    {
        $set_data['events'] = $request->events;
        $set_data['reason'] = $request->reason;
        $set_data['total_people'] = $request->total_people;
        $set_data['location'] = $request->location;
        $set_data['price'] = $request->price;
        $set_data['initial_date'] = $request->initial_date;
        $set_data['final_date'] = $request->final_date;
        $set_data['initial_time'] = $request->initial_time;
        $set_data['final_time'] = $request->final_time;

        if (SpaceRequests::where(['id' => $id])->update($set_data)) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Solicitação atualizada com sucesso');
            } else {
                session()->flash('message', 'Request Updated Successfully');
            }
            return redirect('admin/space-requests');
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Opps! Algo deu errado');
            } else {
                session()->flash('message', 'Opps! Something Went Wrong');
            }
            return back()->withInput();
        }
    }
    public function AdminOrganizationManagement()
    {
        $group_id = session('group-id');
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();

        $groupData = $this->GetGroupList();
        return view('platform/admin/organization/index')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminOrganizationManagement');
    }
    public function AdminEditOrganization(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_events')->where(['id' => $id])->first();
        }
        $data['user'] = User::where('user_id', session('user_id'))->first();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('group_id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        return view('platform/admin/organization/edit', $data);
    }
    public function AdminEditOrganizationPost(EventRequest $request, $id = "")
    {
        $set_data = [];
        $set_data['title'] = $request->title;
        $set_data['group_id'] = $request->group_id;
        $set_data['user_id'] = session('user_id');
        $set_data['updated_at'] = date('Y-m-d H:i:s');

        if (!empty($id)) {
            if (DB::table('space_events')->where(['id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Evento atualizado com sucesso');
                } else {
                    session()->flash('message', 'Event Updated Successfully');
                }
                return redirect('admin/organization-management');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_events')->insertGetId($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Evento adicionado com sucesso');
                } else {
                    session()->flash('message', 'Event Added Successfully');
                }
                return redirect('admin/organization-management');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        }
    }
    public function AdminDeleteOrganization(Request $request, $id)
    {
        DB::table('space_events')->where(['id' => $id])->delete();
        session()->flash('type', 'success');
        if (session('locale') == 'pt') {
            session()->flash('message', 'Organização excluída com sucesso');
        } else {
            session()->flash('message', 'Organization Deleted Successfully');
        }
        return redirect('admin/organization-management');
    }
    public function ReasonManagement()
    {
        $user = Auth::user();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        return view('platform/admin/space/reason/index')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminReasonRequest');
    }
    public function AdminEditReason(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_reason')->where(['id' => $id])->first();
        }
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        return view('platform/admin/space/reason/edit', $data);
    }
    public function AdminPostEditReason(ReasonRequest $request, $id = "")
    {
        $set_data = [];
        $set_data['reason'] = $request->reason;
        $set_data['user_id'] = Auth::user()->id;
        $set_data['group_id'] = session('group-id');
        $set_data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($id)) {
            if (DB::table('space_reason')->where(['id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Motivo  atualizado com sucesso');
                } else {
                    session()->flash('message', 'Reason Updated Successfully');
                }

                return redirect('admin/reason-management');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_reason')->insertGetId($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Motivo adicionado com sucesso');
                } else {
                    session()->flash('message', 'Reason Added Successfully');
                }
                return redirect('admin/reason-management');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        }
    }
    public function AdminDeleteReason(Request $request, $id)
    {
        DB::table('space_reason')->where(['id' => $id])->delete();
        session()->flash('type', 'success');
        if (session('locale') == 'pt') {
            Flash::success('Motivo excluído com sucesso.');
        } else {
            Flash::success('Reason Deleted Successfully.');
        }
        return redirect('admin/space-reasons');
    }
    public function AdminLocationManagement()
    {

        $data = [];
        if (auth()->user()->hasAnyRole('Super Admin','Local Admin')) {
            $data['locations'] = DB::table('space_location')
                ->join('groups', 'groups.id', '=', 'space_location.group_id')
                ->where('space_location.group_id', session('group-id'))
                ->select('space_location.*', 'groups.name as group_name')
                ->latest()->get();
        }
        if(auth()->user()->hasRole('User')){
            $data['locations'] = DB::table('space_location')
                ->join('groups', 'groups.id', '=', 'space_location.group_id')
                ->where('space_location.group_id', session('group-id'))
                ->where('space_location.status', 1)
                ->select('space_location.*', 'groups.name as group_name')
                ->latest()->get();
        }
        if(auth()->user()->hasRole('Module Admin')) {
            $data['locations'] = DB::table('space_location')
                ->where('space_location.group_id', session('group-id'))
                ->where('space_location.added_by', Auth::user()->id)
                ->join('groups', 'groups.id', '=', 'space_location.group_id')
                ->select('space_location.*', 'groups.name as group_name')
                ->latest()->get();

        }

        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['locationTypes'] = DB::table('space_location_type')->select('id', 'location_type')->get();
        $data['page'] = 'LocationManagement';
        //dd($data);
        return view('platform/admin/location/new-index', $data);
    }
    public function AdminNewLocation()
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_location')->where(['id' => $id])->first();
        }
        $data['locationType'] = DB::table('space_location_type')->get();
        $data['managers'] = DB::table('users')->get();
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['materials'] = Material::all();
        $data['functions'] = Functionn::all();
        $data['locationTypes'] = DB::table('space_location_type')->select('id', 'location_type')->get();
        return view('platform/admin/location/new', $data);
    }

    public function AdminEditLocation(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = Location::where(['id' => $id])->first();
        }
        $data['locationType'] = DB::table('space_location_type')->get();
        $data['managers'] = DB::table('users')->get();
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();

        $data['selected_materials'] = Location::find($id)->metarials()->pluck('material_id')->toArray();
        $data['selected_functions'] = Location::find($id)->functions()->pluck('function_id')->toArray();
        $data['materials'] = Material::all();
        $data['functions'] = Functionn::all();
        $data['locationTypes'] = DB::table('space_location_type')->select('id', 'location_type')->get();
        //dd($data);
        return view('platform/admin/location/edit', $data);
    }

    public function AdminViewLocation(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_location')
                ->where(['space_location.id' => $id])->first();
        }
        $data['locationType'] = DB::table('space_location_type')->get();
        $data['managers'] = DB::table('users')->get();
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();

        $data['selected_materials'] = Location::find($id)->metarials()->pluck('material_id')->toArray();
        $data['selected_functions'] = Location::find($id)->functions()->pluck('function_id')->toArray();
        $data['materials'] = Material::all();
        $data['functions'] = Functionn::all();

        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['locationTypes'] = DB::table('space_location_type')->select('id', 'location_type')->get();

        //dd($data);
        return view('platform/admin/location/view', $data);
    }

    public function AdminPostEditLocation(Request $request, $id = "")
    {
        if(!empty($id)){
            $record = DB::table('space_location')->where('id',$id)->first();
            if(Auth::user()->id==$record->added_by){
                $set_data['status'] = 0;
            }
        }
        $group = Group::where('id', session('group-id'))->first();
        $managers = $group->managers()->pluck('user_id');

        $set_data['name'] = $request->address;
        $set_data['address'] = $request->address;
        $set_data['name'] = $request->name;
        $set_data['location_type'] = $request->location_type;
        $set_data['contact'] = $request->contact;
        $set_data['telephone'] = $request->telephone;
        $set_data['period'] = $request->period;
        $set_data['size'] = $request->size;
        $set_data['area_type'] = $request->area_type;
        $set_data['air_conditioner'] = $request->air_conditioner;
        $set_data['total_people'] = $request->total_people;
        $set_data['total_chair'] = $request->total_chair;
        $set_data['total_table'] = $request->total_table;
        $set_data['parking'] = $request->parking;
        $set_data['price'] = $request->price;
        $set_data['budget'] = $request->budget;
        $set_data['others'] = $request->others;
        $set_data['quantity'] = $request->quantity;
        $set_data['notes'] = $request->notes;
        $set_data['manager'] = $request->manager;
        $set_data['edit_by'] = Auth::user()->id;
        $set_data['date'] = date('Y-m-d H:i:s');

        if (!empty($id)) {
            $set_data['updated_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_location')->where(['id' => $id])->update($set_data)) {
                toast(trans('msg.Location Updated Successfully'),'success','top-right')->showCloseButton();
        
                DB::table('location_materials')->where('location_id', $id)->delete();
                DB::table('location_functions')->where('location_id', $id)->delete();
                if ($request->functions && $request->f_quantity) {
                    $functions = array_combine($request->functions, $request->f_quantity);
                    foreach ($functions as  $key => $value) {
                        DB::table('functions')->where('id', $key)->increment('allocated', $value);
                        DB::table('location_functions')->insert(['location_id' => $id, 'function_id' => $key, 'quantity' => $value]);
                    }
                }

                if ($request->materials && $request->m_quantity) {
                    $mearials = array_combine($request->materials, $request->m_quantity);
                    foreach ($mearials as  $key => $value) {
                        DB::table('materials')->where('id', $key)->increment('allocated', $value);
                        DB::table('location_materials')->insert(['location_id' => $id, 'material_id' => $key, 'quantity' => $value]);
                    }
                }

                foreach ($managers as $key => $manager_id) {
                    $alert = array(
                        'user_id' => Auth::user()->id,
                        'group_id' => session('group-id'),
                        'event_name' => 'Secretary reupdated location and seek for approval',
                        'routine' => 'Location Updated',
                        'url' => 'admin/edit-location/' . $id,
                        'model_id' => $id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'notify_to' => $manager_id
                    );
                    DB::table('space_alerts')->insert($alert);
                }
                return redirect('admin/location-management');
            } else {
                toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_location')->insertGetId($set_data)) {
                toast(trans('msg.Location Added Successfully'),'success','top-right')->showCloseButton();
                return redirect('admin/location-management');
            } else {
                toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                return back()->withInput();
            }
        }
    }

    public function AdminPostLocation(Request $request)
    {
        $group = Group::where('id',session('group-id'))->first();
        $managers = $group->managers()->pluck('user_id');
        //dd(array_combine($request->materials,$request->quantity));
        $set_data['name'] = $request->name;
        $set_data['address'] = $request->address;
        $set_data['location_type'] = $request->location_type;
        $set_data['contact'] = $request->contact;
        $set_data['telephone'] = $request->telephone;
        $set_data['period'] = $request->period;
        $set_data['size'] = $request->size;
        $set_data['area_type'] = $request->area_type;
        $set_data['air_conditioner'] = $request->air_conditioner;
        $set_data['total_people'] = $request->total_people;
        $set_data['total_chair'] = $request->total_chair;
        $set_data['total_table'] = $request->total_table;
        $set_data['parking'] = $request->parking;
        $set_data['price'] = $request->price;
        $set_data['budget'] = $request->budget;
        $set_data['others'] = $request->others;
        $set_data['notes'] = $request->notes;
        $set_data['manager'] = session('user_id');
        $set_data['quantity'] = $request->quantity;
        $set_data['rules'] = $request->rules;
        $set_data['added_by'] = Auth::user()->id;
        $set_data['group_id'] = session('group-id');
        $set_data['date'] = date('Y-m-d', strtotime(today()));
        if (!empty($request->file('photos'))) {
            $images = $request->file('photos');
            foreach ($images as $image) {
            $image_name = md5(time()) . rand(111, 999) . '.' . $image->getClientOriginalExtension();
                if ($image->move(public_path() . '/_dados/plataforma/location/images', $image_name)) {
                    $array_img[] = $image_name;
                }
            }
            $set_data['photos'] = implode(",", $array_img);
        }
        if (!empty($request->file('documents'))) {
            $documents = $request->file('documents');
            $documents_name = md5(time()) . rand(111, 999) . '.' . $documents->getClientOriginalExtension();
            if ($documents->move(public_path() . '/_dados/plataforma/location/documents', $documents_name)) {
                $set_data['documents'] = $documents_name;
            }
        }

        if (!empty($request->file('sketch'))) {
            $sketchs = $request->file('sketch');
            foreach ($sketchs as $sketch) {
                $sketch_name = md5(time()) . rand(111, 999) . '.' . $sketch->getClientOriginalExtension();
                if ($sketch->move(public_path() . '/_dados/plataforma/location/sketch', $sketch_name)) {
                    $array_sketch[] = $sketch_name;
                }
            }
            $set_data['sketch'] = implode(",", $array_sketch);
        }

        if (!empty($request->file('blue_print'))) {
            $blue_prints = $request->file('blue_print');
            foreach ($blue_prints as $blue_print) {
                $blue_print_name = md5(time()) . rand(111, 999) . '.' . $blue_print->getClientOriginalExtension();
                if ($blue_print->move(public_path() . '/_dados/plataforma/location/blue_print', $blue_print_name)) {
                    $array1[] = $blue_print_name;
                }
            }
            $set_data['blue_print'] = implode(",", $array1);
        }
        if (!empty($id)) {
            $set_data['updated_at'] = date('Y-m-d H:i:s');
            $number = count($request->rule_name);
            // dd($req->file('rules_documents'), $number);
            if (!empty($request->file('rules_documents'))) {
                $rules_documents = $request->file('rules_documents');
                foreach ($rules_documents as $rules_document) {
                    $rules_documents_name = md5(time()) . rand(111, 999) . '.' . $rules_document->getClientOriginalExtension();
                    $rules_document->move(public_path() . '/_dados/plataforma/location/rules', $rules_documents_name);
                    $array[] = $rules_documents_name;
                }
                if ($number > 0) {
                    for ($i = 0; $i < $number; $i++) {
                        $row = DB::table('space_location_rules')->insert(['rule_name' => $request->rule_name[$i], 'responsible' => $request->responsible[$i], 'rules_documents' => $array[$i], 'location_id' => $request->id, 'created_at' => date('Y-m-d H:i:s'),]);
                    }
                } else {
                    return response()->json(['error' => 'Something Error.']);
                }
            }
            if (DB::table('space_location')->where(['id' => $id])->update($set_data)) {
                toast(trans('msg.Location Updated Successfully'),'success','top-right')->showCloseButton();
                return redirect('admin/location-management');
            } else {
                toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            $insert_id = DB::table('space_location')->insertGetId($set_data);
                if($insert_id){
                    if($request->functions && $request->f_quantity){
                        $functions = array_combine($request->functions, $request->f_quantity);
                        foreach ($functions as  $key => $value) {
                            DB::table('functions')->where('id', $key)->increment('allocated', $value);
                            DB::table('location_functions')->insert(['location_id' => $insert_id, 'function_id' => $key, 'quantity' => $value]);
                        }
                    }

                    if($request->materials && $request->m_quantity){
                        $mearials = array_combine($request->materials, $request->m_quantity);
                        foreach ($mearials as  $key => $value) {
                            DB::table('materials')->where('id', $key)->increment('allocated', $value);
                            DB::table('location_materials')->insert(['location_id' => $insert_id, 'material_id' => $key, 'quantity' => $value]);
                        }
                    }
               // dd($mearials);

                $number = count($request->rule_name);
                // dd($req->file('rules_documents'), $number);
                if (!empty($request->file('rules_documents'))) {
                    $rules_documents = $request->file('rules_documents');
                    foreach ($rules_documents as $rules_document) {
                        $rules_documents_name = md5(time()) . rand(111, 999) . '.' . $rules_document->getClientOriginalExtension();
                        $rules_document->move(public_path() . '/_dados/plataforma/location/rules', $rules_documents_name);
                        $array[] = $rules_documents_name;
                    }
                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {
                            $row = DB::table('space_location_rules')->insert(['rule_name' => $request->rule_name[$i], 'responsible' => $request->responsible[$i], 'rules_documents' => $array[$i], 'location_id' => $insert_id, 'created_at' => date('Y-m-d H:i:s'),]);
                        }
                    } else {
                        toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                    }
                }
                session()->flash('type', 'success');
                toast(trans('msg.Location Added and sent for approval to Manager Successfully'),'success','top- ')->showCloseButton();
                foreach($managers as $key => $manager_id){
                    $alert = array(
                        'user_id' => Auth::user()->id,
                        'group_id' => session('group-id'),
                        'event_name' => 'Secretary seek approval for Location',
                        'routine' => 'Location Created',
                        'url' => 'admin/edit-location/'.$insert_id,
                        'model_id' => $insert_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'notify_to' => $manager_id,
                    );
                    DB::table('space_alerts')->insert($alert);
                }


                return redirect('admin/location-management');
            } else {
                toast(trans('msg.Something Error !'),'error','top-right')->showCloseButton();
                return back()->withInput();
            }
        }
    }
    public function AdminDeleteLocation(Request $request, $id = "")
    {
        DB::table('space_location')->where(['id' => $id])->delete();
        toast(trans('msg.Location Deleted Successfully'),'success','top-right')->showCloseButton();
        return redirect('admin/location-management');
    }
    public function AdminExternalLocation()
    {
        $data = [];
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['page'] = 'ExternalLocation';
        return view('platform/admin/external-location/index', $data);
    }
    public function AdminEditExternalLocation(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_location_type')->where(['id' => $id])->first();
        }
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        return view('platform/admin/external-location/edit', $data);
    }
    public function AdminAlerts()
    {

        session(['isAlertRead' => 1]);

        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['page'] = 'AdminAlertList';
        return view('platform/admin/alerts/index', $data);
    }
    public function AdminPostEditExternalLocation(Request $request, $id = "")
    {
        $set_data = [];
        $set_data['location_type'] = $request->location_type;
        if (!empty($id)) {
            $set_data['updated_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_location_type')->where(['id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Tipo de localidade enviado com sucesso');
                } else {
                    session()->flash('message', 'Location Type Updated Successfully');
                }
                return redirect('admin/external-location');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_location_type')->insertGetId($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Tipo de localidade adicionado com sucesso');
                } else {
                    session()->flash('message', 'Location Type Added Successfully');
                }
                return redirect('admin/external-location');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        }
    }
    public function AdminDeleteExternalLocation(Request $request, $id)
    {
        DB::table('space_location_type')->where(['id' => $id])->delete();
        session()->flash('type', 'success');
        if (session('locale') == 'pt') {
            session()->flash('message', 'Tipo de Localidade excluído com sucesso');
        } else {
            session()->flash('message', 'Location Type Deleted Successfully');
        }
        return redirect('admin/location-types');
    }

    public function AdminSupports()
    {
        $data['user'] = Auth::user();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        $data['page'] = 'AdminSupportList';
        // dd($data);
        return view('platform/admin/supports/index', $data);
    }

    public function AdminEditSupport(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('space_sup_questions')->where(['id' => $id])->first();
        }
        $data['user'] = User::where('user_id', session('user_id'))->first();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('group_id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        //dd($data);
        return view('platform/admin/supports/edit', $data);
    }

    public function AdminPostEditSupport(Request $request, $id = "")
    {
        $set_data = [];
        $set_data['status'] = $request->status;
        $set_data['solution'] = $request->solution;
        $set_data['date_of_solution'] = date('Y-m-d');
        $set_data['updated_by'] = session('user_id');
        if (!empty($id)) {
            // $set_data['updated_at'] = date('Y-m-d H:i:s');
            if (DB::table('space_sup_questions')->where(['id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Solicitação de suporte atualizada com sucesso');
                } else {
                    session()->flash('message', 'Support Request Updated Successfully');
                }

                return redirect('admin/supports');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        }
    }

    public function AdminDeleteSupport(Request $request, $id)
    {
        DB::table('space_sup_questions')->where(['id' => $id])->delete();
        session()->flash('type', 'success');
        if (session('locale') == 'pt') {
            session()->flash('message', 'Solicitação de suporte excluída com sucesso');
        } else {
            session()->flash('message', 'Support Request Deleted Successfully');
        }
        return redirect('admin/supports');
    }

    public function requests()
    {
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        $page = "GroupRequests";
        //dd(session('SuperAdmin'),session('group-id'),$group_requests);
        return view('platform.admin.group.requests')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage($page);
    }

    public function organizations()
    {
        $group_id = session('group-id');
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();

        $groupData = $this->GetGroupList();
        return view('platform/admin/organization/organizations')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminOrganizationList');
    }

    public function EditOrganization(Request $request, $id = "")
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('groups')->where(['group_id' => $id])->first();
        }
        $data['user'] = User::where('user_id', session('user_id'))->first();
        $data['activeGroup'] = $this->ActiveGroup();
        $data['defaultGroup'] = $this->DefaultGroup();
        $data['userGroup'] = $this->UserGroup();
        $data['groupList'] = DB::table('groups')->select('group_id', 'name')->get();
        $data['groupData'] = $this->GetGroupList();
        //dd($data);
        return view('platform/admin/organization/edit-organization', $data);
    }

    public function AdminPostEditGroup(Request $request, $id = "")
    {
        $set_data = [];
        $set_data['name'] = $request->name;
        $set_data['description'] = $request->description;
        $set_data['address'] = $request->address;
        $set_data['schedules'] = $request->schedules;
        $set_data['phone'] = $request->phone;
        $set_data['facebook'] = $request->facebook;
        $set_data['site'] = $request->site;
        $set_data['mapa'] = $request->mapa;
        $set_data['url_el_church'] = $request->url_el_church;
        $set_data['app_store'] = $request->app_store;
        $set_data['url_shop'] = $request->url_shop;
        $set_data['label_media'] = $request->label_media;
        $set_data['description_media'] = $request->description_media;
        $set_data['label_calendar'] = $request->label_calendar;
        $set_data['description_calendar'] = $request->description_calendar;
        $set_data['label_download'] = $request->label_download;
        $set_data['description_download'] = $request->description_download;
        $set_data['label_application'] = $request->label_application;
        $set_data['label_comunication'] = $request->label_comunication;
        $set_data['contact_us'] = $request->contact_us;
        if (!empty($id)) {
            $set_data['updated_at'] = date('Y-m-d H:i:s');
            if (DB::table('groups')->where(['group_id' => $id])->update($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Grupo atualizado com sucesso');
                } else {
                    session()->flash('message', 'Group Updated Successfully');
                }
                return redirect('admin/organizations');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        } else {
            $set_data['created_at'] = date('Y-m-d H:i:s');
            if (DB::table('groups')->insertGetId($set_data)) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Grupo adicionado com sucesso');
                } else {
                    session()->flash('message', 'Group Added Successfully');
                }
                return redirect('admin/organizations');
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return back()->withInput();
            }
        }
    }

    public function AdminPostDeleteGroup(Request $request, $id)
    {
        DB::table('groups')->where(['group_id' => $id])->delete();
        session()->flash('type', 'success');
        if (session('locale') == 'pt') {
            session()->flash('message', 'Grupo excluído com sucesso');
        } else {
            session()->flash('message', 'Group Deleted Successfully');
        }
        return redirect('admin/organizations');
    }

    public function LocationMarkAsBlock(Request $request)
    {
        $location = DB::table('space_location')->where('id', $request->id)->update(['is_flag' => 1, 'flag_reason' => $request->flag_reason]);
        if ($location) {
            toast(trans('msg.Location Mark as Blocked'),'success','top-right')->showCloseButton();
            return redirect('admin/location-management');
        } else {
            toast(trans('msg.Opps! Something Went Wrong'),'error','top-right')->showCloseButton();
            return back()->withInput();
        }
    }

    public function LocationMarkAsUnBlock(Request $request)
    {
        $location = DB::table('space_location')->where('id', $request->id)->update(['is_flag' => 0, 'flag_reason' => $request->flag_reason]);
        if ($location) {
            toast(trans('msg.Location Mark as Unblocked'),'success','top-right')->showCloseButton();
            return redirect('admin/location-management');
        } else {
            toast(trans('msg.Opps! Something Went Wrong'),'error','top-right')->showCloseButton();
            return back()->withInput();
        }
    }

    public function SpaceRequestsInLocation($address)
    {

        $group_id = session('group-id');
        $user = User::where('id', session('user_id'))->first();
        $apps = $this->ActiveGroup();

        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();

        return view('platform/admin/space/index')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminSpaceRequest')->withAddress($address);
    }

    public function ChangeView($view)
    {
        session()->put('location-view', $view);

        return back();
    }


    public function users()
    {

        $group_id = session('group-id');
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();
        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $allgroups = DB::table('groups')->get();
        if (session('SuperAdmin') == 1) {
            $users = DB::table('users')->join('groups', 'groups.group_id', '=', 'users.group_id')
                ->select('users.*', 'groups.*', 'groups.name as group_name', 'users.name as user_name')->get();
        } elseif (session('LocalAdmin') == 1) {
            $users = DB::table('users')->join('groups', 'groups.group_id', '=', 'users.group_id')
                ->select('users.*', 'groups.*', 'groups.name as group_name', 'users.name as user_name')
                ->where('users.group_id', session('group-id'))
                ->where('users.distributor_level', 0)
                //->where('users.level', 0)
                ->get();
        } else {
            $users = DB::table('users')->join('groups', 'groups.group_id', '=', 'users.group_id')
                ->select('users.*', 'groups.*', 'groups.name as group_name', 'users.name as user_name')
                ->where('users.group_id', session('group-id'))
                ->where('users.manager_level', 0)
                ->where('users.distributor_level', 0)
                //->where('users.level', 0)
                ->get();
        }
        $groupData = $this->GetGroupList();
        return view('platform/admin/user/users')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('AdminUserList')->withUsers($users)->withAllgroups($allgroups);
    }

    public function NewUser()
    {
        $group_id = session('group-id');
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();

        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        $allgroups = DB::table('groups')->get();
        return view('platform/admin/user/new')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('NewUser')->withAllgroups($allgroups);
    }

    public function CreateUser(Request $request)
    {

        $ip = request()->ip();
        $request->request->add(['created_at_ip' => $ip]);
        $data = request()->except(['_token']);
        $insert = DB::table('users')->insert($data);
        if ($insert) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                session()->flash('message', 'pt-User Created Successfully');
            } else {
                session()->flash('message', 'User Created Successfully');
            }
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Opps! Algo deu errado');
            } else {
                session()->flash('message', 'Opps! Something Went Wrong');
            }
        }
        return redirect('admin/users')->withInput();
    }

    public function user_edit($id)
    {
        $userData = DB::table('users')->where('user_id', $id)->first();

        $group_id = session('group-id');
        $user = User::where('user_id', session('user_id'))->first();
        $apps = $this->ActiveGroup();

        $defaultGroup = $this->DefaultGroup();
        $userGroup = $this->UserGroup();
        $groupData = $this->GetGroupList();
        $allgroups = DB::table('groups')->get();
        return view('platform/admin/user/edit')->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup)->withPage('EditUser')->withEditUser($userData)->withAllgroups($allgroups);
    }

    public function user_update(Request $request)
    {
        $ip = request()->ip();
        $request->request->add(['created_at_ip' => $ip]);
        $data = request()->except(['_token']);
        $update = DB::table('users')->where('user_id', $request->user_id)->update($data);
        if ($update) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                session()->flash('message', 'pt-User Updated Successfully');
            } else {
                session()->flash('message', 'User Updated Successfully');
            }
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Opps! Algo deu errado');
            } else {
                session()->flash('message', 'Opps! Something Went Wrong');
            }
        }
        return redirect('admin/users')->withInput();
    }
}
