<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SpaceRequests extends Model
{
    protected $table="space_requests";
    protected  $fillable = ['events', 'group_id','space_manager', 'reason', 'total_people', 'location', 'price', 'initial_date', 'initial_time', 'final_date', 'final_time', 'space', 'location_requester', 'is_draft','user_id','status', 'is_repproved', 'is_priority'];
	public static function InsertRequest($request,$groupName){
		$sert_data['user_id']=session('user_id');
		$sert_data['events']=$request->events;
		$sert_data['space_manager']=$request->space_manager;
		$sert_data['reason']=$request->reason;
		$sert_data['total_people']=$request->total_people;
		$sert_data['location']=$request->location;
		$sert_data['price']=$request->price;
		$sert_data['initial_date']=$request->initial_date;
		$sert_data['initial_time']=$request->initial_time;
		$sert_data['final_date']=$request->final_date;
		$sert_data['final_time']=$request->final_time;
		$sert_data['space']=$groupName;
		$sert_data['group_id'] = session('group-id');
		if($request->location_requester){
			$set_data['location_requester']=$request->location_requester;
		}
		$sert_data['created_at']=date('Y-m-d H:i:s');
		return self::insertGetId($sert_data);
	}
	public function user(){
		return $this->belongsTo(User::class,'user_id','id');
	}

	public function metarials()
	{
		return $this->belongsToMany('App\Models\Material', 'requested_materials', 'request_id', 'material_id');
	}

	public function functions()
	{
		return $this->belongsToMany('App\Models\Functionn', 'requested_functions', 'request_id', 'function_id');
	}
}
