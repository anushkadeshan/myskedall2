<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    public $fillable = [
        'user_id',
        'reason',
        'group_id',
        'status',
    ];
}
