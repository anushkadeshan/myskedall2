<?php

namespace App\Http\Controllers;
use DB;
use Mail;
use App\User;
use App\Group;
use App\SpaceRequests;
use App\Mail\ToShareEmail;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Space\ShareSpaceRequest;
use App\Http\Requests\Space\NewRequest;
use App\Mail\Space\AlertToSpaceManager;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function SendGroupRequest(Request $request,$groupId){
        $user_id = session('user_id');

        $record = auth()->user()->groups()->where('group_id',$groupId)->exists();
		if($record){
            if(session('locale')=='pt'){
                Flash::success('Solicitação já enviada');
			    return response()->json(['status'=>'fail','message'=> 'Solicitação já enviada','data'=>$record]);
            }
            else{
                Flash::success('Request Already Send');
			    return response()->json(['status'=>'fail','message'=>'Request Already Send','data'=>$record]);
            }
		}else{
            //send alerts
            $group_name = DB::table('groups')->where('id', $groupId)->first();
            $alert = array(
                'user_id' => $user_id,
                'group_id' => session('group-id'),
                'event_name' => 'User Requested to join ' . $group_name->name . ' group.',
                'routine' => 'Group Request',
                'url' => 'group-requests',
                'created_at' => date('Y-m-d H:i:s')
            );

            DB::table('space_alerts')->insert($alert);
			$set_data['user_id']=$user_id;
			$set_data['group_id']=$groupId;
			$set_data['is_approve']=0;
            $set_data['created_at']=date('Y-m-d H:i:s');


			auth()->user()->groups()->attach($groupId);
            if (session('locale') == 'pt') {
                Flash::success('Solicitação enviada com sucesso');
                return response()->json(['status' => 'success', 'message' => 'Solicitação enviada com sucesso']);
            }
            else{
                Flash::success('Request Send Successfully.');
                return response()->json(['status' => 'success', 'message' => 'Request Send Successfully']);
            }

		}
	}
	public function ShowSpaceRequest(Request $request,$requestType=""){
		$offset=0;
		$order = $request->get('order');
		$orderkey='initial_date';
		$orderkey='asc';
		if($order[0]['column']=='0'){
			$orderkey='initial_date';
			$ordervalue=$order[0]['dir'];
		}elseif($order[0]['column']=='1'){
			$orderkey='initial_time';
			$ordervalue=$order[0]['dir'];
		}elseif($order[0]['column']=='2'){
			$orderkey='events';
			$ordervalue=$order[0]['dir'];
		}elseif($order[0]['column']=='3'){
			$orderkey='space';
			$ordervalue=$order[0]['dir'];
		}

		$routename=$request->routename;
		if($request->routename!="search-request"){
			if($request->routename=='approved-request'){
                if(auth()->user()->hasRole('User')){
                    $data = SpaceRequests::where(['user_id' => session('user_id'), 'status' => 2, 'is_repproved' =>0, 'group_id' => session('group-id')]);
                }
                else{
                    if(auth()->user()->hasRole('Super Admin')){
                        $data = SpaceRequests::where(['status' => 2, 'is_repproved' => 0, 'group_id'=> session('group-id')]);
                    }
                    else{
                        $data = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' => 0]);
                    }
                }
			}elseif($request->routename=='rejected-request'){
                if (auth()->user()->hasRole('User')) {
				    $data = SpaceRequests::where(['user_id' => session('user_id')])->where('status', '<=', 1)->where('group_id', session('group-id'));
                } else {
                    if (auth()->user()->hasRole('Super Admin')) {
				        $data = SpaceRequests::where('status', '<=', 1);
                    } else {
				        $data = SpaceRequests::where(['group_id' => session('group-id')])->where('status', '<=', 1);
                    }
                }
			}elseif($request->routename=='repproved-request'){
                if (auth()->user()->hasRole('User')) {
				    $data = SpaceRequests::where(['user_id' => session('user_id'), 'status' => 2, 'is_repproved' =>1, 'group_id' => session('group-id')]);
                } else {
                    if (auth()->user()->hasRole('Super Admin')) {
				        $data = SpaceRequests::where(['status' => 2, 'is_repproved' =>1, 'group_id' => session('group-id')]);
                    } else {
				        $data = SpaceRequests::where(['group_id' => session('group-id'), 'status' => 2, 'is_repproved' =>1, 'group_id' => session('group-id')]);
                    }
                }
			}else{
                if (auth()->user()->hasRole('User')) {
				    $data = SpaceRequests::where(['user_id' => session('user_id'), 'group_id' => session('group-id')]);

                } else {
                    if (auth()->user()->hasRole('Super Admin')) {
				        $data = SpaceRequests::where('id','>=',1)->where('group_id', session('group-id'));
                    } else {
				        $data = SpaceRequests::where(['group_id' => session('group-id')]);
                    }
                }
			}
			$keyword = $request->get('search')['value'];

			if(!empty($keyword)  && strlen($keyword)>=3){
				$data->where(function ($data) use ($keyword){
					$data->Where('events','LIKE',"%".$keyword."%")
					->orWhere('reason','LIKE',"%".$keyword."%")
					->orWhere('location','LIKE',"%".$keyword."%")
					->orWhere('space','LIKE',"%".$keyword."%");
				});
            }

			//$data=$data->offset(7*$offset)->take(7)->get();
		}else{
			$keyword = $request->get('search')['value'];
			if(!empty($keyword) && strlen($keyword)>=3){
                if(session('level')==0){
				    $data = SpaceRequests::where(['user_id' => session('user_id'), 'group_id' => session('group-id')]);
                }
                else{
                    if(session('SuperAdmin') == 1){
				        $data = SpaceRequests::where('id', '>=', 1)->where('group_id', session('group-id'));
                    }
                    else{
                        $data = SpaceRequests::where(['group_id' => session('group-id')]);
                    }
                }
				$data->where(function ($data) use ($keyword){
					$data->Where('events','LIKE',"%".$keyword."%")
					->orWhere('reason','LIKE',"%".$keyword."%")
					->orWhere('location','LIKE',"%".$keyword."%")
					->orWhere('space','LIKE',"%".$keyword."%");
				});
				//$data=$data->offset(7*$offset)->take(7)->get();
			}else{
				$data=[];
			}
		}
		if(empty($data)){
			$count =0;
		}else{
            $count = $data->count();

            $data = $data->orderBy($orderkey,$ordervalue)->offset($request->get('start'))->take(7)->get();
           // dd($data);
        }
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
	}
	public function ChangeProfilePhoto(Request $request){
        //dd($request->all());
		if(!empty($request->file('files'))){
            $image =$request->file('files');

			$image_name = session('user_id').'.jpg';
			if($image->move(public_path().'/_dados/plataforma/usuarios', $image_name)){
                if (session('locale') == 'pt') {
				    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Upload de foto concluída']);
                }else{
				    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Photo Uploaded Successfully']);
                }
			}else{
                if (session('locale') == 'pt') {
				    return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Arquivo inválido']);
                }
                else{
                    return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Invalid File Required']);
                }
			}
		}else{
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Campo de arquivos necessário']);
            }
            else{
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'File Feild Required']);
            }
		}
    }
    public function DeleteProfilePhoto(){
        $image_name = Auth::user()->id;
        $file_path = public_path().'/_dados/plataforma/usuarios/'. $image_name.'.jpg';
        $delete = unlink($file_path);
        if($delete){
            if (session('locale') == 'pt') {
                session()->flash('message', 'Delete de foto concluída');
            } else {
                session()->flash('message' , 'Photo Deleted Successfully');
            }
        }
        else{
            if (session('locale') == 'pt') {
                session()->flash('message' , 'Opps! Algo deu errado');
            } else {
                session()->flash('message' , 'Opps! Something Went Wrong');
            }
        }

        return back()->withInput();
    }
	public function ChangePassword(Request $request){
		$user = User::where('id',session('user_id'))->first();
		$verifyBy= "pRak_pL@noz";
		$data = DB::select(DB::raw("SELECT AES_DECRYPT(password,'".$verifyBy."') AS password FROM users WHERE user_id=$user->user_id"))[0];
		if(!empty($request->old_password)){
			if(password_verify($request->old_password,$user->password) || $request->old_password==$data->password){
				if(!empty($request->new_password)){
					$set_data['password']=password_hash($request->new_password,PASSWORD_DEFAULT);
					$set_data['updated_at']=date('Y-m-d H:i:s');
					if(User::where('user_id',session('user_id'))->update($set_data)){
                        if (session('locale') == 'pt') {
						    return response()-> json(['code' => 200, 'status' => 'success', 'message' => 'Senha alterada com sucesso']);
                        }
                        else{
                            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Password Changed Successfully']);
                        }
					}else{
                        if (session('locale') == 'pt') {
                            return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Opps! Algo deu errado']);
                        }
                        else{
                            return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Opps! Something Went Wrong']);
                        }
					}
				}else{
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'O novo campo de senhas é necessário']);
                    }
                    else{
                        return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'The New Password Field Required']);
                    }
				}
			}else{
                if (session('locale') == 'pt') {
                    return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'A Senha antiga é inválida']);
                }
                else{
                    return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Invalid Old Password']);
                }
			}
		}else{
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'A Senha antiga é necessária']);
            }
            else{
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Old Password Required']);
            }
		}
	}
	public function ToShareEmail(Request $request){
		$validator = Validator::make($request->all(),['email'=>'required|email']);
		if($validator->failed()){
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Endereço de e-mail inválido']);
            }else{
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Invalid Email Address']);
            }
		}else{
            try {
                Mail::to($request->email)->send(new ToShareEmail());
                if (session('locale') == 'pt') {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Compartilhado com sucesso']);
                }
                else{
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Shared Successfully']);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Something error in Mail Server']);
            }
		}
	}
	public function HelpContactReport(Request $request){
		$set_data['user_id']=session('user_id');
		$set_data['message']=$request->message;
		$set_data['category']=$request->subject;
		$set_data['module']=$request->module;
		$set_data['status']=0;
		$set_data['created_at']=date('Y-m-d H:i:s');
		if(DB::table('space_sup_questions')->insertGetId($set_data)){
            //send alerts
            $alert = array(
                'user_id' => session('user_id'),
                'group_id' => session('group-id'),
                'event_name' => $request->subject,
                'routine' => 'Contact & Support',
                'url' => 'admin/supports',
                'created_at' => date('Y-m-d H:i:s')
            );
            DB::table('space_alerts')->insert($alert);
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Obrigado pelo seu feedback']);
            }else{
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Thanks For Your Feedback']);
            }
		}else{
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Algo deu errado']);
            }
            else{
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Something Went Wrong']);
            }
		}
	}
	public function AdminSpaceRequest(Request $request){
        if($request->address){
            if (auth()->user()->hasRole('Super Admin')) {
                $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
                    ->where('location', $request->address)
                    ->where('space_requests.group_id', session('group-id'));
            } else {
                $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
                ->where('location', $request->address)
                ->where('space_requests.group_id', session('group-id'));
            }
        }
        else{
            if(auth()->user()->hasRole('Super Admin')){
                $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
                ->where('space_requests.group_id', session('group-id'));
            }
            else{
                $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
                ->where('space_requests.group_id',session('group-id'));
            }
        }


		if(!empty($request->get('search')['value'])){
            $search = $request->get('search')['value'];

			$data=$data->where('events','LIKE','%'.$search.'%')
			->orWhere('location','LIKE','%'.$search.'%')
			->orWhere('initial_date','LIKE','%'.$search.'%');
		}
        $count = $data->count();
        $data = $data->offset($request->get('start'))->take(7)->get();

        return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);

	}
	public function IsApproveAdminRequest(Request $request){
        //dd($request->all());
		$reservation=[];
        $record = SpaceRequests::find($request->id);
        $data = SpaceRequests::find($request->id);
			$record->status=$request->status;
			$record->save();
			if($request->status==1){
                $alert = array(
                    'user_id' => Auth::user()->id,
                    'group_id' => session('group-id'),
                    'event_name' => 'Space Request is rejected and please change data or request again',
                    'routine' => 'Space Request Rejected',
                    'url' => 'admin/edit-space-request/' . $request->id,
                    'model_id' => $request->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'notify_to' => $data->user_id
                );
                DB::table('space_alerts')->insert($alert);
            }
			if($request->status==2){
				$set_data=[];
				$set_data['user_id']=$data->user_id;
				$set_data['request_id']=$data->id;
				$set_data['initial_date']=$data->initial_date;
				$set_data['initial_time']=$data->initial_time;
				$set_data['final_date']=$data->final_date;
				$set_data['final_time']=$data->final_time;
				$set_data['events']=$data->events;
				$set_data['reason']=$data->reason;
				$set_data['space_manager']=$data->space_manager;
				$set_data['total_people']=$data->total_people;
				$set_data['location']=$data->location;
				$set_data['price']=$data->price;
				$set_data['location_requester']=$data->location_requester;
				$set_data['space']=$data->space;
                $set_data['created_at']=date('Y-m-d H:i:s');

                DB::table('space_reservations')->insert($set_data);

                for ($i=1; $i <= 6 ; $i++) {
                    DB::table('return_check_list')->insert(['check_list_id'=> $i, 'request_id' => $data->id]);
                }

                $alert = array(
                    'user_id' => Auth::user()->id,
                    'group_id' => session('group-id'),
                    'event_name' => 'Space Request is Approved',
                    'routine' => 'Space Request Approved',
                    'url' => 'admin/edit-space-request/' . $request->id,
                    'model_id' => $request->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'notify_to' => $data->user_id
                );
                DB::table('space_alerts')->insert($alert);
            }
            if (session('locale') == 'pt') {
                Flash::success('Status alterado com sucesso');
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status alterado com sucesso', 'data' => $data]);
            }
            else{
                Flash::success('Status Changed Successfully');
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status Changed Successfully', 'data' => $data]);
            }

	}
	public function AdminOrganizationList(Request $request){
		$data = DB::table('space_events')->select('space_events.*','groups.name','users.name as username')
		->join('users','users.user_id','=','space_events.user_id')
		->join('groups','groups.group_id','=','space_events.group_id');
		if(!empty($request->get('search')['value'])){
			$search = $request->get('search')['value'];
			$data=$data->where('space_events.title','LIKE','%'.$search.'%')
			->orWhere('groups.name','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->get();
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
	}
	public function ChangeOrganizationStatus(Request $request){
		DB::table('space_events')->where(['id'=>$request->id])->update(['status'=>$request->status]);
        if (session('locale') == 'pt') {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status alterado com sucesso', 'data' => $data]);
        } else {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status Changed Successfully', 'data' => $data]);
        }
	}
	public function ReasonManagement(Request $request){
        if (auth()->user()->hasRole('Super Admin')) {
            $data = DB::table('space_reason')->select('space_reason.*', 'users.name')
            ->join('users', 'users.id', '=', 'space_reason.user_id')
            ->where('group_id', session('group-id'));
        } else {
            $data = DB::table('space_reason')->select('space_reason.*', 'users.name')
            ->join('users', 'users.id', '=', 'space_reason.user_id')
            ->where('group_id', session('group-id'));
        }

		if(!empty($request->get('search')['value'])){
			$search = $request->get('search')['value'];
			$data=$data->where('space_reason.reason','LIKE','%'.$search.'%');
			$data=$data->oWhere('users.name','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->get();
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
	}
	public function ChangeReasonStatus(Request $request){
		DB::table('space_reason')->where(['id'=>$request->id])->update(['status'=>$request->status]);
        if (session('locale') == 'pt') {
            Flash::success('Approval saved successfully.');
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status alterado com sucesso']);
        } else {
            Flash::success('Status Changed Successfully.');
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status Changed Successfully',]);
        }
	}
	public function LocationManagement(Request $request){

        if (auth()->user()->hasAnyRole('Super Admin', 'Local Admin')) {
            $data = DB::table('space_location')
            ->join('groups', 'groups.id', '=', 'space_location.group_id')
            ->where('space_location.group_id', session('group-id'))
            ->select('space_location.*', 'groups.name as group_name')
            ->latest();
        }
        if (auth()->user()->hasRole('User')) {
            $data = DB::table('space_location')
            ->join('groups', 'groups.id', '=', 'space_location.group_id')
            ->where('space_location.group_id', session('group-id'))
            ->where('space_location.status', 1)
            ->select('space_location.*', 'groups.name as group_name')
            ->latest();
        }
        if (auth()->user()->hasRole('Module Admin')) {
            $data = DB::table('space_location')
            ->where('space_location.group_id', session('group-id'))
            ->where('space_location.added_by', Auth::user()->id)
            ->join('groups', 'groups.id', '=', 'space_location.group_id')
            ->select('space_location.*', 'groups.name as group_name')
            ->latest();
        }


		if(!empty($request->get('search')['value'])){
			$search = $request->get('search')['value'];
			$data=$data->where('address','LIKE','%'.$search.'%')
				->orWhere('contact','LIKE','%'.$search.'%')
				->orWhere('telephone','LIKE','%'.$search.'%')
				->orWhere('period','LIKE','%'.$search.'%')
				->orWhere('size','LIKE','%'.$search.'%')
				->orWhere('total_people','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->get();

		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
	}
	public function ExternalLocation(Request $request){
		$data = DB::table('space_location_type');
		if(!empty($request->get('search')['value'])){
			$search = $request->get('search')['value'];
			$data=$data->where('location_type','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->get();
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
	}
	public function GetRequestLocation(Request $request){
        $data = DB::table('space_location')
                ->where('is_flag', 0)
                ->where('group_id',session('group-id'))
                ->get();
		$html=[];
		if(!empty($data)){
			foreach($data as $row){
				$option="";
				$option.='<option  value="'.$row->id.'" ';
				if($request->id==$row->id){
					$option.='selected';
				}
				$option.='>'.$row->name.' - '. $row->address.'</option>';
				$html[]=$option;
			}
		}
		if(!empty($html)){
			$htmlstr='<option value="">Select Location</option>'.implode('',$html);
			return response()->json(['code'=>200,'status'=>'success','data'=>$htmlstr]);
		}else{
            if (session('locale') == 'pt') {
                //return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Localização não disponível por este preço']);
            }
            else{
                //return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Location not available for this price']);
            }
		}

	}
	public function GetPriceByLocation(Request $request){
        $price =$request->price;

        $data = DB::table('space_location')->where('space_location.id',$request->locationid)
                ->join('users','users.id','=','space_location.manager')
                ->select('space_location.*','users.name as manager_name','users.id as user_id')
                ->first();
        //dd($data);
        $rules = DB::table('space_location_rules')->where('location_id', $request->locationid)->get();
        dd($data, $rules);
		if($data->price<=$price){
			return response()->json(['code'=>200,'status'=>'success','price'=>$data->price, 'manager'=>$data->manager_name,'rules' => $rules]);
		}else{
			$message= 'O preço é insuficiente para esta localização';
			$json=json_encode(['location'=>$data->address]);
            //DB::table('space_alerts')->insert(['user_id'=>session('user_id'),'alert_message'=>$message,'description'=>$json]);
            //return response()->json(['code' => 200, 'status' => 'fail', 'message' => $message, 'manager' => $data->manager_name]);
            return response()->json(['manager' => $data->manager_name, 'rules' => $rules,'location'=>$data]);
		}
	}
	public function ShareSpaceRequest(Request $request){
		$validator = Validator::make($request->all(),['email'=>'required|email']);
		if($validator->failed()){
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Endereço de e-mail inválido']);
            }
            else{
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Invalid Email Address']);
            }
		}else{
			$data=DB::table('space_requests')->select('users.name as username','users.email as useremail','space_requests.*')
			->join('users','users.id','=','space_requests.user_id')
            ->where(['space_requests.id'=>$request->id])->first();

            try {
                $mail = Mail::to($request->email)->send(new ShareSpaceRequest($data));

                if (session('locale') == 'pt') {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'E-mail enviado com sucesso']);
                } else {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Email Send Successfully']);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 200, 'status' => 'fail', 'message' => 'Something error in mail server']);
            }

		}
	}
	public function SaveRequestPriority(Request $request){
        //send alerts
        $group = Group::select('name')->where(['id' => session('group-id')])->first();

        $data = json_decode($request->request_data);
      //dd($data);
        $location = DB::table('space_location')->where(['id' => $data->location])->first();
        //dd($location);
        $set_data['user_id'] = Auth::user()->id;
        $set_data['events'] = $data->events;
        $set_data['space'] = $group->name;
        $set_data['space_manager'] = $data->space_manager;
        $set_data['reason'] = $data->reason;
        $set_data['total_people'] = $data->total_people;
        $set_data['location'] = $location->address;
        $set_data['price'] = $data->price;
        $set_data['initial_date'] = $data->initial_date;
        $set_data['final_date'] = $data->final_date;
        $set_data['initial_time'] = $data->initial_time;
        $set_data['final_time'] = $data->final_time;
        $set_data['group_id'] = session('group-id');
        $set_data['location_requester'] = $data->location_requester;
        $set_data['is_draft'] = 1;
        $set_data['is_priority'] = 1;
        $draft = SpaceRequests::create($set_data);
        //dd($draft);
        $location = json_decode($request->description);
        //dd($location->location);
        $group = Group::where('id', session('group-id'))->first();
        $managers = $group->managers()->pluck('user_id');

        if (in_array(Auth::user()->id, $managers->toArray())) {
            foreach ($managers as $key => $manager_id) {
                $alert = array(
                    'user_id' => Auth::user()->id,
                    'group_id' => session('group-id'),
                    'event_name' => 'Priority Request Recieved for '. $location->location,
                    'routine' => 'Priority Space Request',
                    'url' => 'admin/space-requests/',
                    'model_id' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'notify_to' => $manager_id
                );
                DB::table('space_alerts')->insert($alert);
            }
        }
        //mail to location manager
        $data = $request->request_data;
        $manager = DB::table('users')->where('id', $request->manager)->first();
        if($manager) {
            try {
                Mail::to($manager->email)->send(new AlertToSpaceManager($data));

                if (session('locale') == 'pt') {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Vamos tentar fornecer localização neste slot de tempo']);
                }
                else{
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'We will try to providing location in this time slot']);
                }
            } catch (\Exception $e) {
                if (session('locale') == 'pt') {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Something error in mail server']);
                } else {
                    return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Something error in mail server']);
                }
            }
        } else {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Could not find the Manager']);
        }
	}
	public function GetSpaceAlerts(Request $request){
        if(auth()->user()->hasRole('Super Admin')){
            $data = DB::table('space_alerts')->select('space_alerts.*', 'users.name as requester', 'groups.name as group_name', 'users.id as user')
            ->join('users', 'users.id', '=', 'space_alerts.user_id')
            ->where('space_alerts.group_id', session('group-id'))
            ->join('groups', 'groups.id', '=', 'space_alerts.group_id');
        }
        else{
            $data = DB::table('space_alerts')->select('space_alerts.*', 'users.name as requester', 'groups.name as group_name', 'users.id as user')
            ->join('users', 'users.id', '=', 'space_alerts.user_id')
            ->join('groups', 'groups.id', '=', 'space_alerts.group_id')
            ->where('space_alerts.group_id', session('group-id'));
        }


		if(!empty($request->get('search')['value'])){
			$search = $request->get('search')['value'];
			$data=$data->where('space_alerts.event_name','LIKE','%'.$search.'%')
				->orWhere('users.name','LIKE','%'.$search.'%')
				->orWhere('groups.name','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->orderBy('id','desc')->get();
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);

    }

    public function Supports(Request $request)
    {
        if(auth()->user()->hasRole('Super Admin')){
            $data = DB::table('space_sup_questions')
                ->join('users', 'users.id', '=', 'space_sup_questions.user_id');

        }
        else if(auth()->user()->hasRole('Local Admin|Module Admin')){
            $data = DB::table('space_sup_questions')
            ->join('users', 'users.id', '=', 'space_sup_questions.user_id')
            ->where('users.group_id', session('group-id'));
        }
        else{
            $data = DB::table('space_sup_questions')
            ->join('users', 'users.id', '=', 'space_sup_questions.user_id')
            ->where('space_sup_questions.user_id',session('user_id'));
        }

        if (!empty($request->get('search')['value'])) {
            $search = $request->get('search')['value'];
            $data = $data->where('message', 'LIKE', '%' . $search . '%');
        }
        $count = $data->count();
        $data = $data->offset($request->get('start'))->take(7)->get();

        return response()->json(['draw' => $request->draw, 'aaData' => $data, 'recordsTotal' => $count, 'recordsFiltered' => $count], 200);
    }

    public function getGroupRequests(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $query = $request->get('query');
            if ($query != '') {
                if(auth()->user()->hasRole('Super Admin')){
                    $group_requests = DB::table('user_groups')
                        ->join('users', 'users.id', '=', 'user_groups.user_id')
                        ->where('approved', 0)
                        ->select('users.*', 'user_groups.*','user_groups.id as request_id', 'users.created_at as created_at')
                        ->where('users.name', 'LIKE', '%' . $query . "%")
                        ->where('user_groups.group_id', session('group-id'))
                        ->get();
                }
                if(auth()->user()->hasAnyRole(['Local Admin','Module Admin'])) {
                    $group_requests = DB::table('group_requests')
                        ->join('users', 'usapproveders.user_id', '=', 'group_requests.user_id')
                        ->select('users.*', 'user_groups.*', 'user_groups.id as request_id', 'users.created_at as created_at')
                        ->where('is_approve', 0)
                        ->where('users.name', 'LIKE', '%' . $query . "%")
                        ->where('user_groups.group_id', session('group-id'))
                        ->get();
                }
            } else {
                if(auth()->user()->hasRole('Super Admin')) {
                    $group_requests = DB::table('user_groups')
                        ->join('users', 'users.id', '=', 'user_groups.user_id')
                        ->select('users.*', 'user_groups.*','user_groups.id as request_id', 'users.created_at as created_at')
                        ->where('approved', 0)
                        ->where('user_groups.group_id', session('group-id'))
                        ->get();

                }
                if(auth()->user()->hasAnyRole(['Local Admin', 'Module Admin'])) {
                    $group_requests = DB::table('user_groups')
                        ->join('users', 'users.id', '=', 'user_groups.user_id')
                        ->select('users.*', 'user_groups.*','user_groups.id as request_id', 'users.created_at as created_at')
                        ->where('user_groups.group_id', session('group-id'))
                        ->where('approved', 0)
                        ->where('user_groups.group_id', session('group-id'))
                        ->get();
                }
            }
            //dd($group_requests);
            if($group_requests) {
                foreach ($group_requests as $key => $request) {
                    $timestamp = strtotime($request->created_at);

                    if(session('locale')=='pt'){
                        $output .= '<tr>' .
                        '<td> <img class="img img-rounded" width="40"
                    src="' . asset('_dados/plataforma/usuarios/' . $request->user_id . '.jpg') . '"/></td>' .
                        '<td width="100px">' . $request->name . ' <br>
                            <font style="font-size:12px">' . $request->email . '</font>
                         </td>' .
                        '<td>' . date("Y-m-d", $timestamp) . '</td>' .
                        '<td><button style="height:30px;" id="accept" onclick="accept(' . $request->request_id . ')"  type="button" class="btn btn-success pull-right">Aceitar</button>
                             <button style="height:30px;" onClick="reject(' . $request->request_id . ')" type="button" class="btn btn-danger pull-right">Rejeitado</button></td>' .
                        '</tr>';
                    }
                    else{
                        $output .= '<tr>' .
                    '<td> <img class="img img-rounded" width="40"
                    src="' . asset('_dados/plataforma/usuarios/' . $request->user_id . '.jpg') . '"/></td>' .
                        '<td width="100px">' . $request->name . ' <br>
                            <font style="font-size:12px">' . $request->email . '</font>
                         </td>' .
                    '<td>' . date("Y-m-d", $timestamp). '</td>' .
                    '<td><button style="height:30px;" id="accept" onclick="accept('. $request->request_id. ')"  type="button" class="btn btn-success pull-right">Accept</button>
                             <button style="height:30px; margin-right:5px;" onClick="reject(' . $request->request_id . ')" type="button" class="btn btn-danger pull-right">Reject</button></td>' .
                    '</tr>';
                    }

                }
                return Response($output);
            }
        }
    }

    public function acceptGroupRequest($id){
       $row =  DB::table('user_groups')->where('id',$id)->update(['approved' => 1, 'approved_at'=> now()]);
    }

    public function rejectGroupRequest($id)
    {
        $row =  DB::table('user_groups')->where('id', $id)->delete();
    }

    public function groups(Request $request)
    {
        if (session('SuperAdmin') == 1) {
            $data = DB::table('groups');
        }else{
            $data = DB::table('groups')
                    ->where('group_id',session('group-id'));
        }

        if (!empty($request->get('search')['value'])) {
            $search = $request->get('search')['value'];
            $data = $data->where('name', 'LIKE', '%' . $search . '%');
            $data = $data->where('description', 'LIKE', '%' . $search . '%');
        }
        $count = $data->count();
        $data = $data->offset($request->get('start'))->take(7)->get();
        //dd($data);
        return response()->json(['draw' => $request->draw, 'aaData' => $data, 'recordsTotal' => $count, 'recordsFiltered' => $count], 200);
    }

    public function markAlertAsSuccess(Request $request){
        $id= $request['id'];

        DB::table('space_alerts')->where('id', $id)->update(['is_read' => 1]);
        $row = DB::table('space_alerts')->where('id',$id)->first();

        return response()->json(['url'=> $row->url]);
    }

    public function SaveRequestAsDraft(Request $request)
    {
        $request->request->add(['is_draft' => 1]);
        $request->request->add(['status' => 0]);
        $validator = Validator::make($request->all(), [
            "events" => 'required',
            "space_manager" => 'required',
            "reason" => 'required',
            "total_people" => 'required|numeric',
            "location" => 'required',
            "initial_date" => 'required|date',
            "initial_time" => 'required|date_format:H:i',
            "final_date" => 'required|date|after_or_equal:initial_date',
            "final_time" => 'required|date_format:H:i',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            // <----- Send the validator here
        } else {
            return "Thank you!";
        }
        //dd($request->all());
        //return back()->withInput();
    }

    public function AlertsUserData($id)
    {
        $data = [];
        if (!empty($id)) {
            $data['data'] = DB::table('users')->where('id', $id)->first();
        }

        return $data;
    }

    public function SpaceRequestsInLocation(Request $request, $address){
        if(session('SuperAdmin')){
            $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
                    ->where('location',$address);
        }
        else{
            $data = DB::table('space_requests')->select('id', 'initial_date', 'initial_time', 'events', 'space', 'status', 'is_repproved')
            ->join('groups', 'groups.name', '=', 'space_requests.space')
            ->where('groups.group_id',session('group-id'));
        }

		if(!empty($request->get('search')['value'])){
            $search = $request->get('search')['value'];

			$data=$data->where('events','LIKE','%'.$search.'%')
			->orWhere('location','LIKE','%'.$search.'%')
			->orWhere('initial_date','LIKE','%'.$search.'%');
		}
		$count = $data->count();
		$data = $data->offset($request->get('start'))->take(7)->get();
		return response()->json(['draw'=>$request->draw,'aaData'=>$data,'recordsTotal'=>$count,'recordsFiltered'=>$count], 200);
    }

    public function DeleteLocationSketchFile(Request $req){
        $location = DB::table('space_location')->where('id',$req->id)->first();
        $sketchArray = explode(",", $location->sketch);
        $deleteKey = array_search($req->file, $sketchArray);

        unset($sketchArray[$deleteKey]);

        $sketchs = implode(",", $sketchArray);

        $old_file = $req->file;

        $file_to_delete = public_path('_dados/plataforma/location/sketch/') . $old_file;
        if (file_exists($file_to_delete)) {
            @unlink($file_to_delete);
            DB::table('space_location')->where('id',$req->id)->update(['sketch'=> $sketchs]);
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Documento deletado com sucesso']);
            }
            else{
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'File Deleted Successfully']);
            }
        }
        else{
            if(session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Documento não deletado, algum coisa errada']);
            }
            else{
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'File Not Deleted, Something Error']);
            }
        }


    }

    public function DeleteLocationPhoto(Request $req)
    {
        $location = DB::table('space_location')->where('id', $req->id)->first();
        $PhotoArray = explode(",", $location->photos);
        $deleteKey = array_search($req->file, $PhotoArray);

        unset($PhotoArray[$deleteKey]);

        $photos = implode(",", $PhotoArray);

        $old_file = $req->file;

        $file_to_delete = public_path('_dados/plataforma/location/images/') . $old_file;
        if (file_exists($file_to_delete)) {
            @unlink($file_to_delete);
            DB::table('space_location')->where('id', $req->id)->update(['photos' => $photos]);
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Documento deletado com sucesso']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'File Deleted Successfully']);
            }
        } else {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Documento não deletado, algum coisa errada']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'File Not Deleted, Something Error']);
            }
        }
    }

    public function NewLocationSketchs(Request $req)
    {

        $location = DB::table('space_location')->where('id', $req->id)->first();
        $sketchArray = explode(",", $location->sketch);
        $photoArray = explode(",", $location->photos);

        //dd($sketchArray);
        if (!empty($req->file('sketch'))) {
            $sketchs = $req->file('sketch');
            foreach ($sketchs as $sketch) {
                $sketch_name = md5(time()) . rand(111, 999) . '.' . $sketch->getClientOriginalExtension();
                if ($sketch->move(public_path() . '/_dados/plataforma/location/sketch', $sketch_name)) {
                    $array[] = $sketch_name;
                }
            }
            //dd($array);
            if(!array_filter($sketchArray)){
                $sketch = $array;
                $sketch = implode(",", $array);
            }
            else{
                $both_arrays = array_merge($sketchArray, $array);
                $sketch = implode(",", $both_arrays);
            }

            //dd($both_arrays,$sketch);
            $insert=DB::table('space_location')->where('id', $req->id)->update(['sketch'=> $sketch]);
            $group = Group::where('id', session('group-id'))->first();
            $managers = $group->managers()->pluck('user_id');

            if($insert){
                if(in_array(Auth::user()->id, $managers->toArray())){
                    foreach ($managers as $key => $manager_id) {
                        $alert = array(
                            'user_id' => Auth::user()->id,
                            'group_id' => session('group-id'),
                            'event_name' => 'Secretary re-updated sketchs/photos of location and seek for approval.',
                            'routine' => 'Location updated',
                            'url' => 'admin/edit-location/' . $req->id,
                            'model_id' => $req->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'notify_to' => $manager_id
                        );
                        DB::table('space_alerts')->insert($alert);
                    }
                }

            }
        }

        if (!empty($req->file('photos'))) {
            $photos = $req->file('photos');
            foreach ($photos as $photo) {
                $photo_name = md5(time()) . rand(111, 999) . '.' . $photo->getClientOriginalExtension();
                if ($photo->move(public_path() . '/_dados/plataforma/location/images', $photo_name)) {
                    $array_photo[] = $photo_name;
                }
            }
            //dd($array);
            if (!array_filter($photoArray)) {
                $photo = $array_photo;
                $photo = implode(",", $array_photo);
            } else {
                $both_arrayss = array_merge($photoArray, $array_photo);
                $photo = implode(",", $both_arrayss);
            }

            //dd($both_arrays,$sketch);
            $insert = DB::table('space_location')->where('id', $req->id)->update(['photos' => $photo]);

        }

        if ($insert) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Files Added Successfully');
            } else {
                session()->flash('message', 'Files Added Successfully');
            }
            return back()->withInput();
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Files Not Added, Something Error');
            } else {
                session()->flash('message', 'Files Not Added, Something Error');
            }
            return back()->withInput();
        }


    }

    public function DeleteLocationBluePrintFile(Request $req)
    {
        $location = DB::table('space_location')->where('id', $req->id)->first();
        $blue_printArray = explode(",", $location->blue_print);
        $deleteKey = array_search($req->file, $blue_printArray);

        unset($blue_printArray[$deleteKey]);

        $blue_prints = implode(",", $blue_printArray);
        $old_file = $req->file;

        $file_to_delete = public_path('_dados/plataforma/location/blue_print/') . $old_file;
        if (file_exists($file_to_delete)) {
            @unlink($file_to_delete);
            DB::table('space_location')->where('id', $req->id)->update(['blue_print' => $blue_prints]);
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Documento deletado com sucesso']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'File Deleted Successfully']);
            }
        } else {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Documento não deletado, algum coisa errada']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'File Not Deleted, Something Error']);
            }
        }
    }

    public function NewLocationBluePrints(Request $req)
    {

        $location = DB::table('space_location')->where('id', $req->id)->first();
        $blue_printArray = explode(",", $location->blue_print);
        //dd($sketchArray);
        if (!empty($req->file('blue_print'))) {
            $blue_prints = $req->file('blue_print');
            foreach ($blue_prints as $blue_print) {
                $blue_print_name = md5(time()) . rand(111, 999) . '.' . $blue_print->getClientOriginalExtension();
                if ($blue_print->move(public_path() . '/_dados/plataforma/location/blue_print', $blue_print_name)) {
                    $array[] = $blue_print_name;
                }
            }
            //dd($array);
            $both_arrays = array_merge($blue_printArray, $array);
            $blue_print = implode(",", $both_arrays);
            //dd($both_arrays,$sketch);
            $insert = DB::table('space_location')->where('id', $req->id)->update(['blue_print' => $blue_print]);
            if ($insert) {
                session()->flash('type', 'success');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Arquivos inseridos com sucesso');
                } else {
                    session()->flash('message', 'Files Added Successfully');
                }

                $group = Group::where('id', session('group-id'))->first();
                $managers = $group->managers()->pluck('user_id');

                if (in_array(Auth::user()->id, $managers->toArray())) {
                    foreach ($managers as $key => $manager_id) {
                        $alert = array(
                            'user_id' => Auth::user()->id,
                            'group_id' => session('group-id'),
                            'event_name' => 'Secretary re-updated blueprints of location and seek for approval.',
                            'routine' => 'Location updated',
                            'url' => 'admin/edit-location/' . $req->id,
                            'model_id' => $req->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'notify_to' => $manager_id
                        );
                        DB::table('space_alerts')->insert($alert);
                    }
                }

                return back()->withInput();
            } else {
                session()->flash('type', 'danger');
                if (session('locale') == 'pt') {
                    session()->flash('message', 'Arquivos não inseridos, alguma coisa errada');
                } else {
                    session()->flash('message', 'Files Not Added, Something Error');
                }
                return back()->withInput();
            }
        }
    }

    public function NewLocationRules(Request $req){
        $number = count($req->rule_name);
       // dd($req->file('rules_documents'), $number);
        $rules_documents = $req->file('rules_documents');
        foreach ($rules_documents as $rules_document) {
            $rules_documents_name = md5(time()) . rand(111, 999) . '.' . $rules_document->getClientOriginalExtension();
            $rules_document->move(public_path() . '/_dados/plataforma/location/rules', $rules_documents_name);
            $array[] = $rules_documents_name;
        }
        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) {
                $row = DB::table('space_location_rules')->insert(['rule_name' => $req->rule_name[$i], 'responsible' => $req->responsible[$i], 'rules_documents' => $array[$i], 'location_id' => $req->id, 'created_at' => date('Y-m-d H:i:s'),]);
            }
        } else {
            return response()->json(['error' => 'Submit youths Details.']);
        }


        if ($row) {
            session()->flash('type', 'success');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Regras inseridas com sucesso');
            } else {
                session()->flash('message', 'Rules Added Successfully');
            }

            $group = Group::where('id', session('group-id'))->first();
            $managers = $group->managers()->pluck('user_id');

            if (in_array(Auth::user()->id, $managers->toArray())) {
                foreach ($managers as $key => $manager_id) {
                    $alert = array(
                        'user_id' => Auth::user()->id,
                        'group_id' => session('group-id'),
                        'event_name' => 'Secretary re-updated rules of location and seek for approval.',
                        'routine' => 'Location updated',
                        'url' => 'admin/edit-location/' . $req->id,
                        'model_id' => $req->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'notify_to' => $manager_id
                    );

                    DB::table('space_alerts')->insert($alert);
                }
            }

            return back()->withInput();
        } else {
            session()->flash('type', 'danger');
            if (session('locale') == 'pt') {
                session()->flash('message', 'Regras não inseridas com sucesso');
            } else {
                session()->flash('message', 'Rules Not Added, Something Error');
            }
            return back()->withInput();
        }
    }

    public function DeleteLocationRule(Request $req)
    {
        $old_file = $req->file;

        $file_to_delete = public_path('_dados/plataforma/location/rules/') . $old_file;
        if (file_exists($file_to_delete)) {
            @unlink($file_to_delete);
            DB::table('space_location_rules')->where('id', $req->id)->delete();
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Regras não inseridas com sucesso']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Rule Deleted Successfully']);
            }
        } else {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Regras não inseridas com sucesso, alguma coisa errada']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Rule Not Deleted, Something Error']);
            }
        }
    }

    public function ChangeUserLevel(Request $req){
        $query = DB::table('users')->where('user_id',$req->id)->update(['level'=> $req->value]);
        //dd($query);
        if($query){
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Level Updated Successfully']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Level Updated Successfully']);
            }
        }
        else{
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Level Not Updated. Something Error']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Level Not Updated. Something Error']);
            }
        }
    }

    public function ChangeUserAdmin(Request $req)
    {
        switch ($req->value) {
            case 'distributor_level':
                $query  = DB::table('users')->where('user_id',$req->id)->update(['distributor_level'=>1 , 'secretary_level'=> 0, 'manager_level'=>0]);
                if ($query) {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Nível atualizado com sucesso']);
                    } else {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Level Updated Successfully']);
                    }
                } else {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Nível não atualizado, algo errado']);
                    } else {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Level Not Updated. Something Error']);
                    }
                }

                break;
            case 'manager_level':
                $query  = DB::table('users')->where('user_id', $req->id)->update(['distributor_level' => 0, 'secretary_level' => 0, 'manager_level' => 1]);
                if ($query) {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Nível atualizado com sucesso']);
                    } else {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Level Updated Successfully']);
                    }
                } else {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Nível não atualizado, algo errado']);
                    } else {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Level Not Updated. Something Error']);
                    }
                }

                break;

            default:
                $query  = DB::table('users')->where('user_id', $req->id)->update(['distributor_level' => 0, 'secretary_level' => 1, 'manager_level' => 0]);
                if ($query) {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Nível atualizado com sucesso']);
                    } else {
                        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Level Updated Successfully']);
                    }
                } else {
                    if (session('locale') == 'pt') {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Nível não atualizado, algo errado']);
                    } else {
                        return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Level Not Updated. Something Error']);
                    }
                }
                break;
        }

    }

    public function ChangeLocationStatus(Request $req)
    {
        $location = DB::table('space_location')->find($req->id);
        //dd($location->added_by);
        if($req->value=="false"){
            $value = 0;
        }
        else{
            $value = 1;
        }
        //dd($req->all());
        $query = DB::table('space_location')->where('id', $req->id)->update(['status' => $value, 'status_update_by' => Auth::user()->id]);

        if ($query) {
            if ($req->value == "false") {
                $alert = array(
                    'user_id' => Auth::user()->id,
                    'group_id' => session('group-id'),
                    'event_name' => 'Space Location is disapproved by manager.',
                    'routine' => 'Location disapproved',
                    'url' => 'admin/view-location/' . $req->id,
                    'model_id' => $req->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'notify_to' => $location->added_by
                );
                DB::table('space_alerts')->insert($alert);
            } else {
                $alert = array(
                    'user_id' => Auth::user()->id,
                    'group_id' => session('group-id'),
                    'event_name' => 'Space Location is approved',
                    'routine' => 'Location Approved',
                    'url' => '/admin/view-location/' . $req->id,
                    'model_id' => $req->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'notify_to' => $location->added_by
                );
                DB::table('space_alerts')->insert($alert);
            }
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status Updated Successfully']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Status Updated Successfully']);
            }
        } else {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Status Not Updated. Something Error']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Status Not Updated. Something Error']);
            }
        }
    }

    public function ChangeUserGroup(Request $req)
    {
        $query = DB::table('users')->where('user_id', $req->id)->update(['group_id' => $req->value]);
        //dd($query);
        if($query) {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Group Updated Successfully']);
            } else {
                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Group Updated Successfully']);
            }
        } else {
            if (session('locale') == 'pt') {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Group Not Updated. Something Error']);
            } else {
                return response()->json(['code' => 401, 'status' => 'fail', 'message' => 'Group Not Updated. Something Error']);
            }
        }
    }

}
