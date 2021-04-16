<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Approval
 * @package App\Models
 * @version January 1, 2021, 6:01 am UTC
 *
 * @property integer $user_id
 * @property string $events
 * @property string $reason
 * @property string $space_manager
 * @property integer $total_people
 * @property string $location
 * @property string $location_requester
 * @property number $price
 * @property string $initial_date
 * @property time $initial_time
 * @property string $final_date
 * @property time $final_time
 * @property string $space
 * @property integer $group_id
 * @property boolean $status
 * @property integer $is_draft
 * @property boolean $is_repproved
 */
class Approval extends Model
{
    

    public $table = 'space_requests';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'events',
        'reason',
        'space_manager',
        'total_people',
        'location',
        'location_requester',
        'price',
        'initial_date',
        'initial_time',
        'final_date',
        'final_time',
        'space',
        'group_id',
        'status',
        'is_draft',
        'is_repproved'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'events' => 'string',
        'reason' => 'string',
        'space_manager' => 'string',
        'total_people' => 'integer',
        'location' => 'string',
        'location_requester' => 'string',
        'price' => 'decimal:2',
        'initial_date' => 'date',
        'final_date' => 'date',
        'space' => 'string',
        'group_id' => 'integer',
        'status' => 'integer',
        'is_draft' => 'integer',
        'is_repproved' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'events' => 'nullable|string|max:255',
        'reason' => 'nullable|string',
        'space_manager' => 'nullable|string|max:255',
        'total_people' => 'required|integer',
        'location' => 'nullable|string',
        'location_requester' => 'nullable|string|max:255',
        'price' => 'required|numeric',
        'initial_date' => 'required',
        'initial_time' => 'required',
        'final_date' => 'required',
        'final_time' => 'required',
        'space' => 'nullable|string|max:255',
        'group_id' => 'nullable|integer',
        'status' => 'required|integer',
        'is_draft' => 'required|integer',
        'is_repproved' => 'required|boolean',
        'created_at' => 'required',
        'updated_at' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    /**
     * Get the user that owns the Approval
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function space_location()
    {
        return $this->belongsTo('App\Location', 'location');
    }
    
}
