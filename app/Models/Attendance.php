<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // User Attendence Values
    const PRESENCE = 'presence';
    const ABSENT = 'absent';
    const LATE = 'late';
    protected $fillable = [
        'teacher_id',
        'user_id',
        'class_id',
        'date',
        'status',
    ];


    public $translatable = ['status'];

    function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    function class ()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}