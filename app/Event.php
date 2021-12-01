<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = [
        'name',
        'start_date',
        'end_date',
        'color'
    ];
}
