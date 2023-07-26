<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;
    protected $guard = 'administrator';

    use HasFactory;

    protected $table = 'administrators';
    protected $fillable = ['administrator_id', 'administrator_name', 'email', 'password', 'administrator_contact', 'administrator_DOB'];    
    protected $primaryKey = 'administrator_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 
}
