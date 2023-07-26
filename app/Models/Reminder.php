<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $table = 'reminders';
    protected $fillable = ['reminder_id', 'original_price', 'desired_price', 'price_change_indicator', 'tenant_id', 'property_id'];    
    protected $primaryKey = 'reminder_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function propertyListing()
    {
        return $this->belongsTo(PropertyListing::class, 'property_id');
    }
}
