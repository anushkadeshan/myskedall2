<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Function
 * @package App\Models
 * @version December 29, 2020, 10:39 am UTC
 *
 * @property string $material
 * @property integer $quantity
 */
class Functionn extends Model
{
    use SoftDeletes;

    public $table = 'functions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'professional',
        'quantity',
        'group_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'professional' => 'string',
        'quantity' => 'integer',
        'group_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'professional' => 'required|string|max:200',
        'quantity' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'group_id' => 'required|integer'
    ];

    /**
     * Get the user that owns the Functionn
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    
}
