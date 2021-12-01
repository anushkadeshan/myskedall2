<?php

namespace App\Models\Approvals;

use App\Models\User;
use App\Models\Approvals\Level;
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

    /**
     * Get the user associated with the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

}
