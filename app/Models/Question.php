<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'has_other',
        'user_id',
    ];
    public function question_options()
    {
        return $this->hasMany(Question_option::class, 'question_id');
    }
}
