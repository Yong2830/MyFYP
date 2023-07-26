<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    use HasFactory;
    protected $table = 'chat_lists';
    protected $primaryKey = 'chat_list_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = [
        'chat_list_id',
        'tenant_id',
        'advertiser_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }

    public function chatHistory()
    {
        return $this->hasMany(ChatHistory::class, 'chat_list_id');
    }
}
