<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

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

    public function Amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities', 'property_id', 'amenity_id');
    }

    public function Images()
    {
        // return $this->belongsToMany(Image::class, 'property_images','property_id','image_id');
        return $this->belongsToMany(Image::class, 'property_images', 'property_id', 'image_id');
    }
    public function Rooms()
    {
        return $this->hasMany(Property_room::class, 'property_id');
    }
    public function PropertyQuestion()
    {
        // return $this->belongsToMany(Image::class, 'property_images','property_id','image_id');
        return $this->belongsToMany(Question::class, 'property_questions', 'property_id', 'question_id');
    }
}
