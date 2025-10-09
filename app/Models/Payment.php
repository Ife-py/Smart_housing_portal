<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'tenant_id',
        'landlord_id',
        'property_id',
        'amount',
        'reference',
        'status', // pending, paid, failed
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

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
