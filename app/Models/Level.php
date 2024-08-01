<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug'
    ];
    public $translatable = ['name', 'slug'];

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'subject_levels');
    }
    function user()
    {
        return $this->belongsToMany(User::class, 'teacher_teaching_subjects', 'level_id', 'user_id');
    }
    function classes()
    {
        return $this->belongsToMany(Classes::class, 'teacher_teaching_subjects', 'level_id', 'class_id');
    }

    function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_teaching_subjects', 'level_id', 'subject_id');
    }

    public function scopeGetLevelBySlug($query, $slug)
    {
        return $query->where('slug->ar', $slug)
            ->orWhere(
                'slug->en',
                $slug
            );
    }

    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }
}