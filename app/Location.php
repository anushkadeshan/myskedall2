<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $table = 'space_location';

     public $fillable = [
         'name',
         'address'
     ];

    public function metarials()
    {
        return $this->belongsToMany('App\Models\Material', 'location_materials', 'location_id', 'material_id')->withPivot('quantity');
    }

    public function functions()
    {
        return $this->belongsToMany('App\Models\Functionn', 'location_functions', 'location_id', 'function_id')->withPivot('quantity');
    }
}
