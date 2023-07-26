<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestrictWord extends Model
{
    use HasFactory;

    protected $table = 'restrict_word';
    protected $primaryKey = 'word_id';
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = false; 

    protected $fillable = [
        'word_id',
        'word_name',
        'administrator_id',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}
