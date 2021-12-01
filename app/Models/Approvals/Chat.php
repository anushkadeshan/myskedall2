<?php

namespace App\Models\Approvals;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    public $timestamps = true;
    public $table = 'request_chats';

    public $fillable = [
        'sender_id', 'date', 'time', 'message', 'is_liked','request_id'
    ];

    /**
     * Get the user that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
