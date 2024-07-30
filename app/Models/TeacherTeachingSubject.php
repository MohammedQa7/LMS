<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTeachingSubject extends Model
{
    use HasFactory;
    protected $fillable =[
        'teacher_id',
        'level_id',
        'class_id',
        'subject_id'
    ];
}
