<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedTenant extends Model
{
    use HasFactory;
    protected $table = 'rejected_tenant';
    protected $primaryKey = 'rejected_tenant_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['rejected_tenant_id', 'rejected_date', 'rejected_reason', 'tenant_id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
