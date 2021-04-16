<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Material
 * @package App\Models
 * @version December 29, 2020, 9:26 am UTC
 *
 * @property string $material
 * @property integer $quantity
 */
class Material extends Model
{
    use SoftDeletes;

    public $table = 'materials';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'material',
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
        'material' => 'string',
        'quantity' => 'integer',
        'group_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'material' => 'required|string|max:200',
        'quantity' => 'required|integer',
        'group_id' => 'required|integer'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
  

    
}
