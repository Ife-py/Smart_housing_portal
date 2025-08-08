<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
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
        'occupation',
        'id_number',
        'id_type',
        'date_of_birth',
        'image_path',
        'password'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];
}
