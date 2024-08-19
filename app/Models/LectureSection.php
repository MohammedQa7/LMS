<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LectureSection extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [
        'id',
        'created_at'
    ];
    public $translatable = ['name'];


    // Relationships
    function lectures()
    {
        return $this->hasMany(Lecture::class , 'lecture_section_id');
    }
    // 
}