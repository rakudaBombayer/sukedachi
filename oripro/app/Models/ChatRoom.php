<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ChatRoom extends Model
{
    use HasFactory;
    
    protected $table = 'chat_rooms';
    protected $primaryKey = 'chat_room_ID';
    protected $fillable = ['chat_room_ID','user_ID'];


    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_room_ID');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_ID');
    }

}