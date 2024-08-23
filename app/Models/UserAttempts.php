<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttempts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at'
    ];

    // Relationships
    function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
    // 

    // SCOPES
    function scopeGetSpecificAttempt($query, $quiz, $user)
    {
        return $query->where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('is_active', true)
        ;
    }


    //
}