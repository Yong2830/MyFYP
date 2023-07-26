<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedAdvertiser extends Model
{
    use HasFactory;
    protected $table = 'rejected_advertiser';
    protected $primaryKey = 'rejected_advertiser_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['rejected_advertiser_id', 'rejected_date', 'rejected_reason', 'advertiser_id'];
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }
}
