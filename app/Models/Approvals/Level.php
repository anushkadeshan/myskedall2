<?php

namespace App\Models\Approvals;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $fillable = [
        'name', 'type', 'description', 'max_value','group_id'
    ];

    /**
     * The roles that belong to the Level
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function approvers()
    {
        return $this->belongsToMany(User::class, 'level_approvers', 'level_id', 'aprrover_id')->withPivot(['level_role','id']);
    }
}
