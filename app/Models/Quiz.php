<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [
        'id',
        'created_at',
    ];

    public $translatable = ['title', 'description'];

    // Relationships

    function attempts()  {
        return $this->hasMany(UserAttempts::class , 'quiz_id');
    }

    // 

    // SCOPES

    function scopeGetQuizByClassAndSubject($query, $class_id, $subject_id)
    {
        return $query->where('class_id', $class_id)
            ->where('subject_id', $subject_id);
    }

    // -----
}