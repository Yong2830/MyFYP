<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeactivatedAdvertiser extends Model
{
    use HasFactory;

    protected $table = 'deactivated_advertiser';
    protected $primaryKey = 'deactivated_advertiser_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = ['deactivated_advertiser_id', 'deactivated_date', 'deactivated_reason', 'advertiser_id'];  
    public function advertiser()
{
    return $this->belongsTo(Advertiser::class, 'advertiser_id');
}
}
