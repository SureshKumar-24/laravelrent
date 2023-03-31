<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'name',
        'icon',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function pro_amenity()
    {
        return $this->belongsToMany(Property::class, 'property_amenities', 'amenity_id', 'property_id');
    }
}
