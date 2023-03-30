<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'property_id',
    ];
}
