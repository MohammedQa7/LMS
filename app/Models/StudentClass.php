<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'level_id',
        'class_id',
        'section_id'
    ];

    function student()
    {
        return $this->belongsTo(User::class);
    }

    function level()
    {
        return $this->belongsTo(Level::class);
    }

    function class ()
    {
        return $this->belongsTo(Classes::class);
    }



    // SCOPES

    function scopegetAllUsersToPromote($query, $level_id, $section_id, $class_id)
    {
        return $query->where('level_id', $level_id)
        ->where('class_id', $class_id)
        ->where('section_id', $section_id);
    }
    // 
}