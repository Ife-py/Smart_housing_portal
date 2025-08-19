<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Landlord extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'company',
        'occupation',
        'id_number',
        'id_type',
        'properties_count',
        'contact_method',
        'date_of_birth',
        'profile_photo',
        'password'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];
}
