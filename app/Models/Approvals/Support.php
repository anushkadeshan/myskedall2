<?php

namespace App\Models\Approvals;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public $table = 'app_approval_supports';
    public $timestamps = true;
    public $fillable = [
        'support', 'message', 'type_of_support', 'support_given', 'support_given_by', 'support_given_on','added_by','group_id'
    ];

}
