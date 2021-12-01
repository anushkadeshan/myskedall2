<?php

namespace App\Http\Controllers;
use DB;
use Mail;
use App\App;
use App\User;
use App\Group;
use App\Location;
use App\SpaceRequests;
use Illuminate\Http\Request;
use App\Mail\Space\RequestRecievied;
use Illuminate\Support\Facades\Auth;
use App\Mail\Space\SubmitRequestMail;;
use App\Http\Requests\Space\NewRequest;

class SpaceController extends Controller
{

    public function GetGroupList()
    {
        $other_groups = auth()->user()->groups()->get()->pluck('id');

        $other_groups = $other_groups->toArray();

        return Group::whereNotIn('id', $other_groups)->get();
    }
    public function AppPermission(Request $request, $key, $value)
    {
        $update = App::where('app_key', $key)->update(['active' => $value]);
        if ($update) {
            return redirect('/apps');
        }
    }
    public function ActiveGroup()
    {
        $group_id = session('group-id');
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
            return $query->where(['user_id' => Auth::id(), 'approved' => 1]);
        })->get();
    }

    public function JoinedGroups()
    {
        $other_groups = auth()->user()->groups()->get()->pluck('id');
        $other_groups = $other_groups->toArray();
        return Group::whereNotIn('id', $other_groups)->get();
    }
	public function Home(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

		$requestTotal = $this->CountRequestTotal();
		return view('space/home/index',compact('requestTotal'))->withRoutename('')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
	}
	private function CountRequestTotal(){
        if (auth()->user()->hasRole('Super Admin')) {
            $approveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' => 0])->count();
            $rejectedTotal = SpaceRequests::where(['group_id' => session('group-id')])->where('status', '<=', 1)->count();
            $repproveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' => 1])->count();
        }
        if (auth()->user()->hasRole('User')) {
            $approveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'user_id' => session('user_id'), 'status' => 2, 'is_repproved' => 0])->count();
            $rejectedTotal = SpaceRequests::where(['group_id' => session('group-id'), 'user_id' => session('user_id')])->where('status', '<=', 1)->count();
            $repproveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'user_id' => session('user_id'), 'status' => 2, 'is_repproved' => 1])->count();
        }

        if (auth()->user()->hasRole('Module Admin')||auth()->user()->hasRole('Secretary')) {
            $approveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' => 0])->count();
            $rejectedTotal = SpaceRequests::where(['group_id' => session('group-id')])->where('status', '<=', 1)->count();
            $repproveTotal = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' => 1])->count();
        }

		return (object)['approveTotal'=>$approveTotal,'rejectedTotal'=>$rejectedTotal,'repproveTotal'=>$repproveTotal];
	}
	public function ApprovedRequest(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

		$requestTotal = $this->CountRequestTotal();
		return view('space/home/index',compact('requestTotal'))->withRoutename('approved-request')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
	}
	public function RejectedRequest(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

		$requestTotal = $this->CountRequestTotal();
		return view('space/home/index',compact('requestTotal'))->withRoutename('rejected-request')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
	}
	public function RepprovedRequest(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

		$requestTotal = $this->CountRequestTotal();
		return view('space/home/index',compact('requestTotal'))->withRoutename('repproved-request')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
	}
	public function SearchRequest(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();


		$requestTotal = $this->CountRequestTotal();
		return view('space/home/index',compact('requestTotal'))->withRoutename('search-request')->withData($data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
	}
	public function NewRequest(Request $request){
        $reuse_id = $request->query('reuse_id');
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

        $requestTotal = $this->CountRequestTotal();

		$data=[];
		if(!empty($reuse_id)){
			$data['data']=SpaceRequests::find($reuse_id);
			$location=DB::table('space_location')->where(['address'=>$data['data']->location])->first();

		}

		$data['eventsList']=DB::table('space_events')->select('id','title')->where(['status'=>1,'group_id'=>session('group-id')])->get();
		$data['reasonList']=DB::table('space_reason')->select('id','reason')->where(['status'=>1, 'group_id' => session('group-id')])->get();
        $data['locationList']=DB::table('space_location')
                            ->where('group_id',session('group-id'))
                            ->select('space_location.*','space_location.id as id', 'space_location.address','manager', 'space_location.name as location_name')->get();
        $data['page']="EditRequest";

        $data['managers'] = User::role(['Local Admin','Module Admin'])->select('name')->get();
        //dd($data);
		return view('space/new-request/index',$data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
    }

	public function NewRequestMethod(NewRequest $request){
        //dd($request->all());
        $group = Group::select('name')->where(['id' => session('group-id')])->first();
        $location = DB::table('space_location')->where(['id' => $request->location])->first();

        $metarials = DB::table('location_materials')->where('location_id', $location->id)->get();
        $functions = DB::table('location_functions')->where('location_id', $location->id)->get();

        if ($request->tactic==2) {
            $set_data['events'] = $request->events;
            $set_data['space'] = $group->name;
            $set_data['space_manager'] = $request->space_manager;
            $set_data['reason'] = $request->reason;
            $set_data['total_people'] = $request->total_people;
            $set_data['location'] = $location->id;
            $set_data['price'] = $request->price;
            $set_data['initial_date'] = $request->initial_date;
            $set_data['final_date'] = $request->final_date;
            $set_data['initial_time'] = $request->initial_time;
            $set_data['final_time'] = $request->final_time;
            $set_data['group_id'] = session('group-id');
            if ($request->location_requester) {
                $set_data['location_requester'] = $request->location_requester;
            }
            $record = SpaceRequests::where(['id' => $request->reuse_id, 'user_id' => auth()->user()->id])->first();
            //dd($record);
            if ($record) {
                $req_id = $request->reuse_id;
                session(['new_sp_req_id' => $req_id]);
                session(['is_draft' => 0]);
                session()->flash('sapce_success', 'yes');
                //send alerts
                $group = Group::where('id', session('group-id'))->first();
                $managers = $group->managers()->pluck('user_id');
                SpaceRequests::where(['id' => $record->id])->update($set_data);
                if ($record) {
                    if (in_array(Auth::user()->id, $managers->toArray())) {
                        foreach ($managers as $key => $manager_id) {
                            $alert = array(
                                'user_id' => Auth::user()->id,
                                'group_id' => session('group-id'),
                                'event_name' => 'Space Request',
                                'routine' => 'Request Resended Successfully',
                                'url' => 'admin/edit-space-request/' . $req_id,
                                'model_id' => $req_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'notify_to' => $manager_id
                            );
                            DB::table('space_alerts')->insert($alert);
                        }
                    }
                }

                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Solicitação reenviada com sucesso');
                } else {
                    session()->flash('message', 'Request Resended Successfully');
                }
                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
            }
            else{
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Permission Error !');
                } else {
                    session()->flash('message', 'Permission Error !');
                }
                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
            }
        }
        else{

        if($request->saveAsDraft){
            $set_data['user_id'] = session('user_id');
            $set_data['events'] = $request->events;
            $set_data['space'] = $group->name;
            $set_data['group_id'] = session('group-id');
            $set_data['space_manager'] = $request->space_manager;
            $set_data['reason'] = $request->reason;
            $set_data['total_people'] = $request->total_people;
            $set_data['location'] = $location->id;
            $set_data['price'] = $request->price;
            $set_data['initial_date'] = $request->initial_date;
            $set_data['final_date'] = $request->final_date;
            $set_data['initial_time'] = $request->initial_time;
            $set_data['final_time'] = $request->final_time;
            $set_data['is_draft'] = 1;
            if ($request->location_requester) {
                $set_data['location_requester'] = $request->location_requester;
            }
            //dd($set_data);
            $draft = SpaceRequests::create($set_data);


            if($draft){
                $req_id = $draft->id;
                session(['new_sp_req_id' => $req_id]);
                session(['is_draft' => 1]);
                session()->flash('sapce_success', 'yes');
                //send alerts
                $group = Group::where('id', session('group-id'))->first();
                $managers = $group->managers()->pluck('user_id');



                if ($draft) {
                    if (in_array(Auth::user()->id, $managers->toArray())) {
                        foreach ($managers as $key => $manager_id) {
                            $alert = array(
                                'user_id' => Auth::user()->id,
                                'group_id' => session('group-id'),
                                'event_name' => 'Space Request',
                                'routine' => 'Space Request saved as draft',
                                'url' => 'admin/edit-space-request/' . $req_id,
                                'model_id' => $req_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'notify_to' => $manager_id
                            );
                            DB::table('space_alerts')->insert($alert);
                        }
                    }
                }

                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Solicitação salva como rascunho com sucesso');
                } else {
                    session()->flash('message', 'Request saved as draft successfully');
                }
                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
            }
            else{
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Opps! Algo deu errado');
                } else {
                    session()->flash('message', 'Opps! Something Went Wrong');
                }
                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
            }

        }
        else{
            if(!empty($location->total_people) && !empty($request->total_people) && $location->total_people>=$request->total_people){
                if($request->price==0){
                    $request->location = $location->id;
                    $fromtime = $request->initial_date . ' ' . $request->initial_time . ':00';
                    $totime =  $request->final_date . ' ' . $request->final_time . ':00';

                    $from = min($fromtime, $totime);
                    $till = max($fromtime, $totime);

                    $query = DB::table('space_requests')->select(DB::raw('CONCAT(initial_date, " ", initial_time) AS initial'), DB::raw('CONCAT(final_date, " ", final_time) AS final'),'status')
                        ->where('location', $request->location)
                        ->where(DB::raw('CONCAT(initial_date, " ", initial_time)'), '<=', $from)
                        ->where(DB::raw('CONCAT(final_date, " ", final_time)'), '>=', $till)
                        ->first();
                        //dd($query, '1');
                    switch ($query) {
                        case null:
                            $request->request->add(['group_id' => session('group-id')]);
                            $insert = SpaceRequests::InsertRequest($request, $group->name);

                                if ($insert) {
                                    $data = [
                                        'groupname' => $group->name, 'events' => $request->events,
                                        'location' => $location->address, 'price' => $request->price,
                                        'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                        'final_date' => $request->final_date, 'final_time' => $request->final_time
                                    ];

                                    foreach ($metarials as $key => $value) {
                                        DB::table('requested_materials')->insert(['request_id' => $insert, 'location_id' => $location->id, 'metarial_id' => $value->material_id, 'quantity' => $value->quantity]);
                                    }

                                    foreach ($functions as $key => $value) {
                                        DB::table('requested_functions')->insert(['request_id' => $insert, 'location_id' => $location->id, 'function_id' => $value->function_id, 'quantity' => $value->quantity]);
                                    }
                                    //send alerts
                                    $group = Group::where('id', session('group-id'))->first();
                                    $managers = $group->managers()->pluck('user_id');

                                    if (in_array(Auth::user()->id, $managers->toArray())) {
                                        foreach ($managers as $key => $manager_id) {
                                            $alert = array(
                                                'user_id' => Auth::user()->id,
                                                'group_id' => session('group-id'),
                                                'event_name' => 'Space Request Recieved',
                                                'routine' => 'Space Request Recieved',
                                                'url' => 'admin/edit-space-request/' . $insert,
                                                'model_id' => $insert,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'notify_to' => $manager_id
                                            );
                                            DB::table('space_alerts')->insert($alert);
                                        }
                                    }

                                    //mail to requester
                                    $email = Auth::user()->email;
                                    try {
                                        Mail::to($email)->send(new SubmitRequestMail($data));
                                        session()->flash('type', 'success');
                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Solicitação adicionada com sucesso');
                                        } else {
                                            session()->flash('message', 'Request Added Successfully');
                                        }
                                    } catch (\Exception $e) {
                                        session()->flash('type', 'success');
                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Solicitação adicionada com sucesso');
                                        } else {
                                            session()->flash('message', 'Something error in mail server. But Request Added Successfully');
                                        }
                                    }
                                    //mail to location manager
                                    $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                    if ($manager) {
                                        $data['manager'] = $manager->name;
                                        try {
                                            Mail::to($manager->email)->send(new RequestRecievied($data));
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        } catch (\Exception $e) {
                                            if (session('locale') == 'pt') {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            } else {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            }
                                        }
                                    } else {
                                        if (session('locale') == 'pt') {
                                            $message = 'O pedido foi um sucesso';
                                        } else {
                                            $message = 'Request is Successed';
                                        }
                                    }

                                    session()->flash('sapce_success', 'yes');

                                    $description = $insert;
                                    session(['new_sp_req_id' => $description]);
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                } else {
                                    return back()->withInput();
                                }


                            break;

                        default:
                            if($query->status == 2){
                                if (session('locale') == 'pt') {
                                    $message = 'Desculpe, a localização não está disponível. Por favor, entre em contato com o gerente.';
                                }
                                else{
                                    $message = 'Sorry ; Location is not available. Please Contact Manager';
                                }
                                $manager_id = $location->manager;
                                session()->flash('type', 'danger');
                                session()->flash('message', $message);
                                session()->flash('manager', $manager_id);
                                session()->flash('space_data', json_encode($request->all()));
                                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);

                            }
                            else{
                                if (session('locale') == 'pt') {
                                    $message = 'Localização já reservada neste horário';
                                }
                                else{
                                    $message = 'Location already booked in this time slot';
                                }
                                $manager_id = $location->manager;
                                session()->flash('type', 'danger');
                                session()->flash('message', $message);
                                session()->flash('manager', $manager_id);
                                session()->flash('space_data', json_encode($request->all()));
                                $description = json_encode(['location' => $request->location, 'fromtime' => $fromtime, 'totime' => $totime]);
                                session()->flash('space_alert', $description);
                                return back()->withInput();
                            }
                            break;
                    }

                }
                else{
                    if ($location->price <= $request->price) {
                        $request->location = $location->id;
                        $fromtime = $request->initial_date . ' ' . $request->initial_time . ':00';
                        $totime =  $request->final_date . ' ' . $request->final_time . ':00';

                        $from = min($fromtime, $totime);
                        $till = max($fromtime, $totime);

                        $query = DB::table('space_requests')->select(DB::raw('CONCAT(initial_date, " ", initial_time) AS initial'), DB::raw('CONCAT(final_date, " ", final_time) AS final'),'status','location')
                        ->where('location', $request->location)
                            ->where(DB::raw('CONCAT(initial_date, " ", initial_time)'), '<=', $from)
                            ->where(DB::raw('CONCAT(final_date, " ", final_time)'), '>=', $till)
                            ->first();
                           // dd($query, '2',$request->location);
                        switch ($query) {
                            case null:
                                $request->request->add(['group_id' => session('group-id')]);

                                $insert = SpaceRequests::InsertRequest($request, $group->name);
                                if ($insert) {
                                    $data = [
                                        'groupname' => $group->name, 'events' => $request->events,
                                        'location' => $location->address, 'price' => $request->price,
                                        'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                        'final_date' => $request->final_date, 'final_time' => $request->final_time
                                    ];

                                    foreach ($metarials as $key => $value) {
                                        DB::table('requested_materials')->insert(['request_id' => $insert, 'location_id' => $location->id, 'metarial_id' => $value->material_id, 'quantity' => $value->quantity]);
                                    }

                                    foreach ($functions as $key => $value) {
                                        DB::table('requested_functions')->insert(['request_id' => $insert, 'location_id' => $location->id, 'function_id' => $value->function_id, 'quantity' => $value->quantity]);
                                    }
                                     //send alerts
                                    $group = Group::where('id', session('group-id'))->first();
                                    $managers = $group->managers()->pluck('user_id');

                                    if (in_array(Auth::user()->id, $managers->toArray())) {
                                        foreach ($managers as $key => $manager_id) {
                                            $alert = array(
                                                'user_id' => Auth::user()->id,
                                                'group_id' => session('group-id'),
                                                'event_name' => 'Space Request Recieved',
                                                'routine' => 'Space Request Recieved',
                                                'url' => 'admin/edit-space-request/' . $insert,
                                                'model_id' => $insert,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'notify_to' => $manager_id
                                            );
                                            DB::table('space_alerts')->insert($alert);
                                        }
                                    }

                                    //mail to requester
                                    $email = Auth::user()->email;

                                    Mail::to($email)->send(new SubmitRequestMail($data));
                                    session()->flash('type', 'success');
                                    if (session('locale') == 'pt') {
                                        session()->flash('message', 'Solicitação adicionada com sucesso');
                                    } else {
                                        session()->flash('message', 'Request Added Successfully');
                                    }

                                    //mail to location manager
                                    $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                    if ($manager) {
                                        $data['manager'] = $manager->name;
                                        try {
                                            Mail::to($manager->email)->send(new RequestRecievied($data));
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        } catch (\Exception $e) {
                                            if (session('locale') == 'pt') {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            } else {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            }
                                        }
                                    } else {
                                        if (session('locale') == 'pt') {
                                            $message = 'O pedido foi um sucesso';
                                        } else {
                                            $message = 'Request is Successed';
                                        }
                                    }
                                    $description = $insert;
                                    session(['new_sp_req_id' => $description]);
                                    session()->flash('sapce_success', 'yes');

                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                } else {
                                    return back()->withInput();
                                }
                                break;

                            default:
                                if ($query->status == 2) {
                                    if (session('locale') == 'pt') {
                                        $message = 'Desculpe, a localização não está disponível. Por favor, entre em contato com o gerente.';
                                    } else {
                                        $message = 'Sorry ; Location is not available. Please Contact Manager';
                                    }
                                    $manager_id = $location->manager;
                                    session()->flash('type', 'danger');
                                    session()->flash('message', $message);
                                    session()->flash('manager', $manager_id);
                                    session()->flash('space_data', json_encode($request->all()));
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                } else {
                                    if (session('locale') == 'pt') {
                                        $message = 'Localização já reservada neste horário';
                                    } else {
                                        $message = 'Location already booked in this time slot';
                                    }
                                    $manager_id = $location->manager;
                                    session()->flash('type', 'danger');
                                    session()->flash('message', $message);
                                    session()->flash('manager', $manager_id);
                                    session()->flash('space_data', json_encode($request->all()));
                                    $description = json_encode(['location' => $request->location, 'fromtime' => $fromtime, 'totime' => $totime]);
                                    session()->flash('space_alert', $description);
                                    return back()->withInput();
                                }
                                break;
                        }
                    } else {
                        session()->flash('type', 'danger');
                        if (session('locale') == 'pt') {
                            session()->flash('message', 'O preço é insuficiente para este local');
                        }
                        else{
                            session()->flash('message', 'Price is insufficient for this location');
                        }
                        return back()->withInput();
                    }
                }

            }else{
                session()->flash('type','danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Máximo de ' . $location->total_people . ' pessoas permitidas nesta localização');
                }
                else{
                    session()->flash('message', 'Maximum ' . $location->total_people . ' People allowed in this location');
                }
                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
            }
        }
        }
	}
	public function ReuseRequest($request_id){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

        $requestTotal = $this->CountRequestTotal();
		$data=[];
		$data['data'] = SpaceRequests::find($request_id);
		$data['eventsList']=DB::table('space_events')->select('id','title')->where(['status'=>1,'group_id'=>session('group-id')])->get();
		$data['reasonList']=DB::table('space_reason')->select('id','reason')->where(['status'=>1, 'group_id' => session('group-id')])->get();
		$location=DB::table('space_location')->where(['address'=>$data['data']->location])->first();

		if(!empty($location)){
			$data['locationjson']=json_encode(['id'=>$location->id,'text'=>$location->address]);
		}else{
			$data['locationjson']="";
		}
        $data['page']="EditRequest";
        $data['managers'] = User::with('roles')->whereHas('roles', function ($query) {
                $query->whereIn('roles.name', ['Super Admin', 'Local Admin', 'Module Admin']);
                $query->select('users.name as name');
                return $query;
            })->get();
        $data['locationList'] = DB::table('space_location')
        ->where('group_id', session('group-id'))
        ->select('space_location.id as id', 'space_location.address', 'manager', 'space_location.address as location_name')->get();

        return view('space/reuse-request/index',$data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);

    }
    /*
	public function ReuseRequestPost(NewRequest $request,$request_id){

		$group = Group::select('name')->where(['group_id'=>session('group-id')])->first();
		$location = DB::table('space_location')->where(['id'=>$request->location])->first();
		if(!empty($location->total_people) && !empty($request->total_people) && $location->total_people>=$request->total_people){
			if($location->price<=$request->price){
				$request->location=$location->address;
				$fromtime=$request->initial_date.' '.$request->initial_time;
				$totime=$request->final_date.' '.$request->final_time;
				$record= DB::select(DB::raw("SELECT * FROM space_requests WHERE
					`location`='".$request->location."' AND id!=$request_id AND ('".$fromtime."' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR '".$totime."' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
					OR CONCAT(initial_date,' ',initial_time) BETWEEN '".$fromtime."' AND '".$totime."'
					OR CONCAT(final_date,' ',final_time) BETWEEN '".$fromtime."' AND '".$totime."')"
				));
				if(!empty($record)){
					session()->flash('type','danger');
					session()->flash('message','Location already booked in this time slot');
					return back()->withInput();
				}else{
					$reservation= DB::select(DB::raw("SELECT * FROM space_reservations WHERE
						`location`='".$request->location."' AND ('".$fromtime."' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
						OR '".$totime."' BETWEEN CONCAT(initial_date,' ',initial_time) AND CONCAT(final_date,' ',final_time)
						OR CONCAT(initial_date,' ',initial_time) BETWEEN '".$fromtime."' AND '".$totime."'
						OR CONCAT(final_date,' ',final_time) BETWEEN '".$fromtime."' AND '".$totime."')"
					));
					if(empty($reservation)){

						$set_data['events']=$request->events;
						$set_data['space']=$group->name;
						$set_data['space_manager']=$request->space_manager;
						$set_data['reason']=$request->reason;
						$set_data['total_people']=$request->total_people;
						$set_data['location']=$request->location;
						$set_data['price']=$request->price;
						$set_data['initial_date']=$request->initial_date;
						$set_data['final_date']=$request->final_date;
						$set_data['initial_time']=$request->initial_time;
						$set_data['final_time']=$request->final_time;
						if($request->location_requester){
							$set_data['location_requester']=$request->location_requester;
						}
						//$set_data['status']=0;
						$record = SpaceRequests::where(['id'=>$request_id,'user_id'=>session('user_id')])->first();
						if($record){
							if(SpaceRequests::where(['id'=>$record->id])->update($set_data)){
                                session()->flash('type','success');
                                if (session('locale') == 'pt') {
                                    session()->flash('message', 'Solicitação reenviada com sucesso');
                                }
                                else{
                                    session()->flash('message', 'Request Resended Successfully');
                                }
								return redirect('space');
							}else{
                                session()->flash('type','danger');
                                if (session('locale') == 'pt') {
                                    session()->flash('message', 'Opps! Algo deu errado');
                                } else {
                                    session()->flash('message', 'Opps! Something Went Wrong');
                                }
								return back()->withInput();
							}
						}else{
							session()->flash('type','danger');
                            if (session('locale') == 'pt') {
                                session()->flash('message', 'Opps! Algo deu errado');
                            } else {
                                session()->flash('message', 'Opps! Something Went Wrong');
                            }
							return back()->withInput();
						}
					}else{
                        if (session('locale') == 'pt') {
                            $message = 'Localização já reservada neste horário';
                        } else {
                            $message = 'Location already booked in this time slot';
                        }
						$description=json_encode(['location'=>$request->location,'fromtime'=>$fromtime,'totime'=>$totime]);
						session()->flash('space_alert',$description);
						session()->flash('type','danger');
						session()->flash('message',$message);
						return back()->withInput();
					}
				}
			}else{
                session()->flash('type','danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'O preço é insuficiente para este local');
                } else {
                    session()->flash('message', 'Price is insufficient for this location');
                }
				return back()->withInput();
			}
		}else{
            session()->flash('type','danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Máximo de ' . $location->total_people . ' pessoas permitidas nesta localização');
            } else {
                session()->flash('message', 'Maximum ' . $location->total_people . ' People allowed in this location');
            }
			return back()->withInput();
		}


    }
    */

    public function ReuseRequestPost(NewRequest $request,$request_id)
    {
       // dd($request->all());
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

        $requestTotal = $this->CountRequestTotal();

        $group = Group::select('name')->where(['id' => session('group-id')])->first();
        $location = DB::table('space_location')->where(['address' => $request->location])->first();
       //dd($location, $request->location);
        if (!empty($location->total_people) && !empty($request->total_people) && $location->total_people >= $request->total_people) {

            if ($request->price == 0) {
                $request->location = $location->id;
                $fromtime = $request->initial_date . ' ' . $request->initial_time . ':00';
                $totime =  $request->final_date . ' ' . $request->final_time . ':00';

                $from = min($fromtime, $totime);
                $till = max($fromtime, $totime);

                $query = DB::table('space_requests')->select(DB::raw('CONCAT(initial_date, " ", initial_time) AS initial'), DB::raw('CONCAT(final_date, " ", final_time) AS final'), 'status')
                    ->where('location', $request->location)
                    ->where(DB::raw('CONCAT(initial_date, " ", initial_time)'), '<=', $from)
                    ->where(DB::raw('CONCAT(final_date, " ", final_time)'), '>=', $till)
                    ->first();


                switch ($query) {
                    case null:
                        $set_data['events'] = $request->events;
                        $set_data['space'] = $group->name;
                        $set_data['space_manager'] = $request->space_manager;
                        $set_data['reason'] = $request->reason;
                        $set_data['total_people'] = $request->total_people;
                        $set_data['location'] = $location->id;
                        $set_data['price'] = $request->price;
                        $set_data['initial_date'] = $request->initial_date;
                        $set_data['final_date'] = $request->final_date;
                        $set_data['initial_time'] = $request->initial_time;
                        $set_data['final_time'] = $request->final_time;
                        $set_data['group_id'] = session('group-id');
                        if ($request->location_requester) {
                            $set_data['location_requester'] = $request->location_requester;
                        }
                        $record = SpaceRequests::where(['id' => $request_id, 'user_id' => auth()->user()->id])->first();
                       ////////////
                        if ($record) {
                            if($record->is_draft==0){
                                if (SpaceRequests::where(['id' => $record->id])->update($set_data)) {
                                    session()->flash('type', 'success');
                                    $data = [
                                        'groupname' => $group->name, 'events' => $request->events,
                                        'location' => $location->address, 'price' => $request->price,
                                        'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                        'final_date' => $request->final_date, 'final_time' => $request->final_time
                                    ];

                                    //send alerts
                                    $alert = array(
                                        'user_id' => session('user_id'),
                                        'group_id' => session('group-id'),
                                        'event_name' => 'Space Request',
                                        'routine' => 'Space Request Resended ',
                                        'url' => 'admin/space-requests',
                                        'created_at' => date('Y-m-d H:i:s')
                                    );
                                    DB::table('space_alerts')->insert($alert);

                                    if (session('locale') == 'pt') {
                                        session()->flash('message', 'Solicitação reenviada com sucesso');
                                    } else {
                                        session()->flash('message', 'Request Resended Successfully');
                                    }
                                    //mail to location manager
                                    $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                    if($manager) {
                                        $data['manager'] = $manager->name;
                                        try {
                                            Mail::to($manager->email)->send(new RequestRecievied($data));
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        } catch (\Exception $e) {
                                            if (session('locale') == 'pt') {
                                                $message = 'Algo errado no servidor de e-mail Mas, solicitação feita com sucesso';
                                            } else {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            }
                                        }
                                    } else {
                                        if (session('locale') == 'pt') {
                                            $message = 'O pedido foi um sucesso';
                                        } else {
                                            $message = 'Request is Successed';
                                        }
                                    }
                                    $description = $request_id;
                                    session(['ext_sp_req_id' => $description]);
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                } else {
                                    session()->flash('type', 'danger');
                                    if (session('locale') == 'pt') {
                                        session()->flash('message', 'Opps! Algo deu errado');
                                    } else {
                                        session()->flash('message', 'Opps! Something Went Wrong1');
                                    }
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                }
                            }
                            else{
                                $set_data['is_draft'] = 0;
                                if (SpaceRequests::where(['id' => $record->id])->update($set_data)) {
                                    session()->flash('type', 'success');
                                    $data = [
                                        'groupname' => $group->name, 'events' => $request->events,
                                        'location' => $location->address, 'price' => $request->price,
                                        'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                        'final_date' => $request->final_date, 'final_time' => $request->final_time
                                    ];
                                    //send alerts
                                    $alert = array(
                                        'user_id' => session('user_id'),
                                        'group_id' => session('group-id'),
                                        'event_name' => 'Space Request',
                                        'routine' => 'Drafted Request make as real request  ',
                                        'url' => 'admin/space-requests',
                                        'created_at' => date('Y-m-d H:i:s')
                                    );
                                    DB::table('space_alerts')->insert($alert);

                                    if (session('locale') == 'pt') {
                                        session()->flash('message', 'Solicitação adicionada com sucesso');
                                    } else {
                                        session()->flash('message', 'Request Added Successfully');
                                    }
                                    //mail to location manager
                                    $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                    if ($manager) {
                                        $data['manager'] = $manager->name;
                                        try {
                                            Mail::to($manager->email)->send(new RequestRecievied($data));
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        } catch (\Exception $e) {
                                            if (session('locale') == 'pt') {
                                                $message = 'Algo errado no servidor de e-mail Mas, solicitação feita com sucesso';
                                            } else {
                                                $message = 'Something error in mail server. But Request Added Successfully';
                                            }
                                        }
                                    } else {
                                        if (session('locale') == 'pt') {
                                            $message = 'O pedido foi um sucesso';
                                        } else {
                                            $message = 'Request is Successed';
                                        }
                                    }
                                    $description = $request_id;
                                    session(['space_success' => $description]);
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                } else {
                                    session()->flash('type', 'danger');
                                    if (session('locale') == 'pt') {
                                        session()->flash('message', 'Opps! Algo deu errado');
                                    } else {
                                        session()->flash('message', 'Opps! Something Went Wrong');
                                    }
                                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                }
                            }

                        } else {
                            session()->flash('type', 'danger');
                            if (session('locale') == 'pt') {
                                session()->flash('message', 'Opps! Algo deu errado');
                            } else {
                                session()->flash('message', 'Opps! Something Went Wrong');
                            }
                            return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                        }
                        /////////////

                        break;

                    default:

                        if ($query->status == 2) {
                            if (session('locale') == 'pt') {
                                $message = 'Desculpe, a localização não está disponível. Por favor, entre em contato com o gerente.';
                            } else {
                                $message = 'Sorry ; Location is not available. Please Contact Manager';
                            }
                            $manager_id = $location->manager;
                            session()->flash('type', 'danger');
                            session()->flash('message', $message);
                            session()->flash('manager', $manager_id);
                            session()->flash('space_data', json_encode($request->all()));
                            return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                        } else {
                            if (session('locale') == 'pt') {
                                $message = 'Localização já reservada neste horário';
                            } else {
                                $message = 'Location already booked in this time slot';
                            }
                            $manager_id = $location->manager;
                            session()->flash('type', 'danger');
                            session()->flash('message', $message);
                            session()->flash('manager', $manager_id);
                            session()->flash('space_data', json_encode($request->all()));
                            $description = json_encode(['location' => $request->location, 'fromtime' => $fromtime, 'totime' => $totime]);
                            session()->flash('space_alert', $description);
                            return back()->withInput();
                        }
                        break;
                }
            } else {

                if ($location->price <= $request->price) {

                    $request->location = $location->id;
                    $fromtime = $request->initial_date . ' ' . $request->initial_time . ':00';
                    $totime =  $request->final_date . ' ' . $request->final_time . ':00';

                    $from = min($fromtime, $totime);
                    $till = max($fromtime, $totime);
                    // dd();

                    $query = DB::table('space_requests')->select(DB::raw('CONCAT(initial_date, " ", initial_time) AS initial'), DB::raw('CONCAT(final_date, " ", final_time) AS final'),'status')
                        ->where('location', $request->location)
                        ->where(DB::raw('CONCAT(initial_date, " ", initial_time)'), '<=', $from)
                        ->where(DB::raw('CONCAT(final_date, " ", final_time)'), '>=', $till)
                        ->where('user_id','!=',Auth::user()->id)

                        ->first();
                    //dd($query, $from, Auth::user()->id);
                    switch ($query) {
                        case null:
                            $set_data['events'] = $request->events;
                            $set_data['space'] = $group->name;
                            $set_data['space_manager'] = $request->space_manager;
                            $set_data['reason'] = $request->reason;
                            $set_data['total_people'] = $request->total_people;
                            $set_data['location'] = $location->id;
                            $set_data['price'] = $request->price;
                            $set_data['initial_date'] = $request->initial_date;
                            $set_data['final_date'] = $request->final_date;
                            $set_data['initial_time'] = $request->initial_time;
                            $set_data['final_time'] = $request->final_time;
                            $set_data['group_id'] = session('group-id');
                            if ($request->location_requester) {
                                $set_data['location_requester'] = $request->location_requester;
                            }
                            $record = SpaceRequests::where(['id' => $request_id, 'user_id' => session('user_id')])->first();
                            ////////////
                            if ($record) {
                                if ($record->is_draft == 0) {
                                    if (SpaceRequests::where(['id' => $record->id])->update($set_data)) {
                                        session()->flash('type', 'success');
                                        $data = [
                                            'groupname' => $group->name, 'events' => $request->events,
                                            'location' => $location->address, 'price' => $request->price,
                                            'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                            'final_date' => $request->final_date, 'final_time' => $request->final_time
                                        ];

                                        //send alerts
                                        $alert = array(
                                            'user_id' => session('user_id'),
                                            'group_id' => session('group-id'),
                                            'event_name' => 'Space Request',
                                            'routine' => 'Space Request Resended ',
                                            'url' => 'admin/space-requests',
                                            'created_at' => date('Y-m-d H:i:s')
                                        );
                                        DB::table('space_alerts')->insert($alert);

                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Solicitação reenviada com sucesso');
                                        } else {
                                            session()->flash('message', 'Request Resended Successfully');
                                        }
                                        //mail to location manager
                                        $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                        if ($manager) {
                                            $data['manager'] = $manager->name;
                                            try {
                                                Mail::to($manager->email)->send(new RequestRecievied($data));
                                                if (session('locale') == 'pt') {
                                                    $message = 'O pedido foi um sucesso';
                                                } else {
                                                    $message = 'Request is Successed';
                                                }
                                            } catch (\Exception $e) {
                                                if (session('locale') == 'pt') {
                                                    $message = 'Algo errado no servidor de e-mail Mas, solicitação feita com sucesso';
                                                } else {
                                                    $message = 'Something error in mail server. But Request Added Successfully';
                                                }
                                            }
                                        } else {
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        }
                                        $description = $request_id;
                                        session(['ext_sp_req_id' => $description]);
                                        return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                    } else {
                                        session()->flash('type', 'danger');
                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Opps! Algo deu errado');
                                        } else {
                                            session()->flash('message', 'Opps! Something Went Wrong3');
                                        }
                                        return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                    }
                                } else {
                                    $set_data['is_draft'] = 0;
                                    if (SpaceRequests::where(['id' => $record->id])->update($set_data)) {
                                        session()->flash('type', 'success');
                                        $data = [
                                            'groupname' => $group->name, 'events' => $request->events,
                                            'location' => $location->address, 'price' => $request->price,
                                            'initial_date' => $request->initial_date, 'initial_time' => $request->initial_time,
                                            'final_date' => $request->final_date, 'final_time' => $request->final_time
                                        ];

                                        //send alerts
                                        $alert = array(
                                            'user_id' => session('user_id'),
                                            'group_id' => session('group-id'),
                                            'event_name' => 'Space Request',
                                            'routine' => 'Drafted Request make as real request  ',
                                            'url' => 'admin/space-requests',
                                            'created_at' => date('Y-m-d H:i:s')
                                        );
                                        DB::table('space_alerts')->insert($alert);

                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Solicitação adicionada com sucesso');
                                        } else {
                                            session()->flash('message', 'Request Added Successfully');
                                        }
                                        //mail to location manager
                                        $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();

                                        $manager = DB::table('users')->where('id', $location->manager)->select('email', 'name')->first();
                                        if ($manager) {
                                            $data['manager'] = $manager->name;
                                            try {
                                                Mail::to($manager->email)->send(new RequestRecievied($data));
                                                if (session('locale') == 'pt') {
                                                    $message = 'O pedido foi um sucesso';
                                                } else {
                                                    $message = 'Request is Successed';
                                                }
                                            } catch (\Exception $e) {
                                                if (session('locale') == 'pt') {
                                                    $message = 'Algo errado no servidor de e-mail Mas, solicitação feita com sucesso';
                                                } else {
                                                    $message = 'Something error in mail server. But Request Added Successfully';
                                                }
                                            }
                                        } else {
                                            if (session('locale') == 'pt') {
                                                $message = 'O pedido foi um sucesso';
                                            } else {
                                                $message = 'Request is Successed';
                                            }
                                        }
                                        $description = $request_id;
                                        session(['space_success' => $description]);
                                        return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                    } else {
                                        session()->flash('type', 'danger');
                                        if (session('locale') == 'pt') {
                                            session()->flash('message', 'Opps! Algo deu errado');
                                        } else {
                                            session()->flash('message', 'Opps! Something Went Wrong3');
                                        }
                                        return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                                    }
                                }
                            } else {
                                session()->flash('type', 'danger');
                                if (session('locale') == 'pt') {
                                    session()->flash('message', 'Opps! Algo deu errado');
                                } else {
                                    session()->flash('message', 'Opps! Something Went Wrong');
                                }
                                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                            }
                            /////////////
                            break;

                        default:
                            if ($query->status == 2) {
                                if (session('locale') == 'pt') {
                                    $message = 'Desculpe, a localização não está disponível. Por favor, entre em contato com o gerente.';
                                } else {
                                    $message = 'Sorry ; Location is not available. Please Contact Manager';
                                }
                                $manager_id = $location->manager;
                                session()->flash('type', 'danger');
                                session()->flash('message', $message);
                                session()->flash('manager', $manager_id);
                                session()->flash('space_data', json_encode($request->all()));
                                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                            } else {
                                if (session('locale') == 'pt') {
                                    $message = 'Localização já reservada neste horário';
                                } else {
                                    $message = 'Location already booked in this time slot';
                                }
                                $manager_id = $location->manager;
                                session()->flash('type', 'danger');
                                session()->flash('message', $message);
                                session()->flash('manager', $manager_id);
                                session()->flash('space_data', json_encode($request->all()));
                                $description = json_encode(['location' => $request->location, 'fromtime' => $fromtime, 'totime' => $totime]);
                                session()->flash('space_alert', $description);
                                return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                            }
                            break;
                    }
                } else {
                    session()->flash('type', 'danger');
                    if (session('locale') == 'pt') {
                        session()->flash('message', 'O preço é insuficiente para este local');
                    } else {
                        session()->flash('message', 'Price is insufficient for this location');
                    }
                    return redirect()->action([SpaceController::class, 'Home'], ['id' => 12]);
                }
            }
        } else {
            //dd($location);
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Máximo de ' . $location->total_people . ' pessoas permitidas nesta localização');
            } else {
                session()->flash('message', 'Maximum ' . $location->total_people . ' People allowed in this location');
            }
            return back()->withInput();
        }

    }

    public function searchSpaceRequests(){
        $groupData = $this->GetGroupList();
        $user = Auth::user();
        $data = [];
        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

        $requestTotal = $this->CountRequestTotal();

        return view('space/search-requests/search', compact('requestTotal'))->withRoutename('')
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
    }

    public function ViewRequest($request_id){
        $groupData = $this->GetGroupList();
        $user = User::where('id', session('user_id'))->first();

        $apps = $this->ActiveGroup();
        //dd($apps->app_tasks, $user->app_tasks);
        //  dd($user->app_tasks);
        $userGroup = $this->UserGroup();
        $defaultGroup = $this->DefaultGroup();

        $data = [];
        $data['data'] = SpaceRequests::find($request_id);
        $data['eventsList'] = DB::table('space_events')->select('id', 'title')->where(['status' => 1, 'group_id' => session('group-id')])->get();
        $data['reasonList'] = DB::table('space_reason')->select('id', 'reason')->where(['status' => 1])->get();
        $location = DB::table('space_location')->where(['address' => $data['data']->location])->first();

        if (!empty($location)) {
            $data['locationjson'] = json_encode(['id' => $location->id, 'text' => $location->address]);
        } else {
            $data['locationjson'] = "";
        }
        $data['page'] = "EditRequest";
        $managers = User::role(['Super Admin','Local Admin','Module Admin'])->pluck('id');
        $data['managers'] = User::whereIn('id', $managers)->select('name')->get();
        return view('space/search-requests/view', $data)
            ->withUser($user)->withGroupData($groupData)
            ->withActiveGroup($apps)->withDefaultGroup($defaultGroup)
            ->withUserGroup($userGroup);
    }



}
