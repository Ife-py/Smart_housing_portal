<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class Properties extends Model
{
	protected $table = 'properties';

	protected $fillable = [
		'landlord_id',
		'title',
		'address',
		'city',
		'state',
		'price',
		'type',
		'description',
		'features',
		'images',
		'cover_image',
		'status',
	];

	protected $casts = [
		'images' => 'array',
	];

	// Relationship to landlord
	public function landlord()
	{
		return $this->belongsTo(Landlord::class, 'landlord_id');
	}
	
	public function isActive()
	{
		return strtolower($this->status) === 'active';
	}

	public function applications(){
		return $this->hasMany(Application::class);
	}
}
