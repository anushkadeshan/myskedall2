<?php

namespace App\Models\Approvals;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'request_types';
    public $fillable = [
        'type', 'description','group_id'
    ];
}
