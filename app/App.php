<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    public $timestamps = true;

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_apps', 'app_id', 'group_id');
    }

    
}
