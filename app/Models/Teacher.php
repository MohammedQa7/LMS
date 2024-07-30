<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];

    public $translatable = ['name', 'gender', 'city', 'address'];


    function levels()
    {
        return $this->belongsToMany(Level::class, 'teacher_teaching_subjects', 'teacher_id', 'level_id');
    }

    function classes()
    {
        return $this->belongsToMany(Classes::class, 'teacher_teaching_subjects', 'teacher_id', 'class_id');
    }

    function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_teaching_subjects', 'teacher_id', 'subject_id');
    }

    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }
}