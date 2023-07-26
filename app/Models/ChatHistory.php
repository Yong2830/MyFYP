<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;
    protected $table = 'chat_histories';
    protected $primaryKey = 'chat_message_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = [
        'chat_message_id',
        'chat_message_content',
        'chat_message_timestamp',
        'sender_id',
        'receiver_id',
        'chat_list_id',
    ];

    public function chatList()
    {
        return $this->belongsTo(ChatList::class, 'chat_list_id');
    }


}
