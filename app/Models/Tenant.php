<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Appliation;

class Tenant extends Authenticatable
{   
    use HasFactory;
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
    public function isActive()  {
        return $this->active == 1; // or whatever value means 'active' in your database
    }

    public function applications(){
        return $this->hasMany(Appliation::class);
    }
}
