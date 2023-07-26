<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeactivatedTenant extends Model
{
    use HasFactory;
    protected $table = 'deactivated_tenant';
    protected $primaryKey = 'deactivated_tenant_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['deactivated_tenant_id', 'deactivated_date', 'deactivated_reason', 'tenant_id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
