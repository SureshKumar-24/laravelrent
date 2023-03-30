<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'caption',
        'user_id',
        'file_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pro_images()
    {
        return $this->belongsToMany(Property::class, 'property_images', 'image_id', 'property_id');
    }
}
