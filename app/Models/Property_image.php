<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_image extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'image_id',
        'property_id',
    ];
}
