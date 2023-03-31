<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_option extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'text',
        'preferred',
        'question_id',
    ];
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
