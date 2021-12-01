<?php

namespace App\Models\Approvals;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = 'request_items';
    public $timestamps = true;
    public $fillable = [
        'name', 'value', 'approved_value', 'details', 'reference_link', 'responsible_dept', 'payment_method', 'request_id','approve_observations','status','approved_by','approved_at'
    ];

}
