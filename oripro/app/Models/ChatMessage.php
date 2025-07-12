<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';
    protected $primaryKey = 'chat_message_ID';
    protected $fillable = ['chat_room_ID', 'user_ID', 'text'];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }
}
