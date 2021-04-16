<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table="groups";
	public $timestamps = true;

	protected $fillable = ['group_id', 'approved'];

	public function users(){
		return $this->belongsToMany('App\User', 'user_groups', 'group_id', 'user_id')->withPivot('approved');
	}

    public function apps()
    {
        return $this->belongsToMany('App\App', 'group_apps', 'group_id', 'app_id');
	}
	
	public function managers()
	{
		return $this->belongsToMany('App\User', 'groups_managers', 'group_id', 'user_id');
	}
}
