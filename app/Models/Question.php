<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
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
    public function pro_Questions()
    {
        return $this->belongsToMany(Property::class, 'property_questions', 'question_id', 'property_id');
    }
    // public function pro_questions()
    // {
    //     return $this->belongsToMany(Property::class, 'property_questions', 'property_id', 'question_id');
    // }
}
