<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Landlord extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'sex',
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

    public function isActive()  {
        return $this->active == 1; // or whatever value means 'active' in your database
    }
}
