<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Alert
 * @package App\Models
 * @version December 18, 2020, 6:10 am UTC
 *
 * @property integer $user_id
 * @property integer $model_id
 * @property string $event_name
 * @property integer $group_id
 * @property string $routine
 * @property boolean $is_read
 * @property string $url
 * @property integer $updated_by
 * @property integer $deleted_by
 */
class Alert extends Model
{
    use SoftDeletes;

    public $table = 'space_alerts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'model_id',
        'event_name',
        'group_id',
        'routine',
        'is_read',
        'url',
        'updated_by',
        'deleted_by',
        'notify_to'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'model_id' => 'integer',
        'event_name' => 'string',
        'group_id' => 'integer',
        'routine' => 'string',
        'is_read' => 'boolean',
        'url' => 'string',
        'updated_by' => 'string',
        'deleted_by' => 'integer',
        'notify_to' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'model_id' => 'nullable|integer',
        'notify_to' => 'nullable|integer',
        'event_name' => 'required|string|max:255',
        'group_id' => 'nullable|integer',
        'routine' => 'nullable|string|max:255',
        'is_read' => 'required|boolean',
        'url' => 'nullable|string|max:255',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'updated_by' => 'nullable|string',
        'deleted_by' => 'nullable|integer'
    ];


    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }
}
