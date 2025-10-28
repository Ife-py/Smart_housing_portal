<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;
use App\Models\Landlord;
use App\Models\Properties;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'landlord_id',
        'property_id',
        'subject',
        'description',
        'status',
        'attachments',
        'is_read_by_landlord',
        'is_read_by_tenant',
        'landlord_acknowledged',
        'tenant_acknowledged',
        'tenant_response',
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_read_by_landlord' => 'boolean',
        'is_read_by_tenant' => 'boolean',
        'landlord_acknowledged' => 'boolean',
        'tenant_acknowledged' => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }

    public function property()
    {
        return $this->belongsTo(Properties::class, 'property_id');
    }
}
