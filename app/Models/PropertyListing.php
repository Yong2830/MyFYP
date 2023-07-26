<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyListing extends Model
{
    use HasFactory;
    protected $table = 'property_listings';
    protected $primaryKey = 'property_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = [
        'property_id',
        'property_name',
        'property_address',
        'property_address_state',
        'property_postal',
        'property_description',
        'property_housing_type',
        'property_image1',
        'property_image2',
        'property_image3',
        'property_image4',
        'property_image5',
        'property_type',
        'property_number_room',
        'property_room_type',
        'property_rental_status',
        'property_posting_status',
        'property_price',
        'property_post_date',
        'property_updated_date',
        'property_feature',
        'reject_reason',
        'advertiser_id',
    ];

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function reminder()
    {
        return $this->hasMany(Reminder::class, 'property_id');
    }
}
