<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tenant extends Authenticatable
{
    use Notifiable;
    protected $guard = 'tenant';

    use HasFactory;

    protected $table = 'tenants';
    protected $fillable = ['tenant_id', 'tenant_name', 'email', 'password', 'tenant_contact', 'tenant_DOB'];    
    protected $primaryKey = 'tenant_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    public function chats()
    {
        return $this->hasMany(ChatList::class, 'tenant_id');
    }

}
