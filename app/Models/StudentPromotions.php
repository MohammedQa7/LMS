<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPromotions extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at'
    ];

    // Relationships
    function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    function fromLevel()
    {
        return $this->belongsTo(Level::class, 'from_level');
    }

    function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    function fromClass()
    {
        return $this->belongsTo(Classes::class, 'from_class');
    }

    function toLevel()
    {
        return $this->belongsTo(Level::class, 'to_level');
    }

    function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }

    function toClass()
    {
        return $this->belongsTo(Classes::class, 'to_class');
    }

    // -----
}