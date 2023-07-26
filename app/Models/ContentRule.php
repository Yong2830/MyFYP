<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentRule extends Model
{
    use HasFactory;

    protected $table = 'content_rule';
    protected $primaryKey = 'rule_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = [
        'rule_id',
        'rule_name',
        'violated_times',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}
