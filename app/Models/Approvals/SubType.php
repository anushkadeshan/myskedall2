<?php

namespace App\Models\Approvals;

use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    protected $table = 'request_subtypes';
    public $fillable = [
        'sub_type', 'description' ,'type_id','group_id'
    ];
}
