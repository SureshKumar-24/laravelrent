<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'property_id',
        'url',
        'caption',
        'room_type'
    ];
    public function Property_room()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
