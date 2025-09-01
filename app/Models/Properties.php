<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	];

	protected $casts = [
		'images' => 'array',
	];

	// Relationship to landlord
	public function landlord()
	{
		return $this->belongsTo(Landlord::class, 'landlord_id');
	}
}
