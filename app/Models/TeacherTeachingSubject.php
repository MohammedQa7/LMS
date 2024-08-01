<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTeachingSubject extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'level_id',
        'class_id',
        'subject_id'
    ];


    function user() {
        return $this->belongsTo(User::class);
    }

    function level() {
        return $this->belongsTo(Level::class);
    }

    function class() {
        return $this->belongsTo(Classes::class);
    }
    function subject() {
        return $this->belongsTo(Subject::class);
    }

    
}
