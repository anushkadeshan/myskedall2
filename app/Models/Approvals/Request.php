<?php

namespace App\Models\Approvals;

use App\Models\User;
use App\Models\Approvals\Level;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $table = 'requests';
    public $timestamps = true;

    public $fillable = [
        'title', 'description', 'group_id', 'type', 'sub_type', 'due_date', 'limit_date', 'priority', 'level', 'status','requster_id','current_status','total_value','sean_by_user','color','url'
    ];

    /**
     * Get the user that owns the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function levels()
    {
        return $this->belongsTo(Level::class, 'level');
    }

    /**
     * Get all of the comments for the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'request_id');
    }

    /**
     * Get all of the comments for the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function finance()
    {
        return $this->hasMany(Finance::class, 'request_id');
    }

    /**
     * Get all of the comments for the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'request_id');
    }

    /**
     * Get the user associated with the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requester()
    {
        return $this->hasOne(User::class, 'id','requster_id');
    }

    public function approvars()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    /**
     * Get the user associated with the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

     /**
      * Get the user associated with the Request
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
     public function requestType()
     {
         return $this->hasOne(Type::class, 'id', 'type');
     }

     public function subtype()
     {
         return $this->hasOne(SubType::class, 'id', 'sub_type');
     }

     public function group()
     {
         return $this->hasOne(Group::class, 'id', 'group_id');
     }

}
