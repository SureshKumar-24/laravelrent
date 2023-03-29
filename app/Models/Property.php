<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'property_type',
        'description',
        'tenancy_status',
        'street',
        'city',
        'postal_code',
        'state',
        'country',
        'longitude',
        'latitude',
        'area',
        'funishing_status',
        'funishing_details',
    ];

    public function property_amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities', 'amenity_id', 'property_id');
    }
    public function property_images()
    {
        return $this->belongsToMany(Image::class, 'property_images', 'image_id', 'property_id');
    }
}
