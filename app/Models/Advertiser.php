<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Authenticatable
{
    use Notifiable;
    protected $guard = 'advertiser';

    use HasFactory;

    protected $table = 'advertisers';
    protected $fillable = ['advertiser_id', 'advertiser_name', 'email', 'password', 'advertiser_contact', 'advertiser_DOB'];    
    protected $primaryKey = 'advertiser_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    public function propertyListings()
    {
        return $this->hasMany(PropertyListing::class);
    }

    public function chats()
    {
        return $this->hasMany(ChatList::class, 'advertiser_id');
    }
}
