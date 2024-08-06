<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name', 'slug'];

    public $translatable = ['name', 'slug'];

    // Relationships
    function level()
    {
        return $this->belongsToMany(Level::class, 'subject_levels');
    }

    function materials()
    {
        return $this->hasMany(Material::class);
    }
    function teacher()
    {
        return $this->hasOne(TeacherTeachingSubject::class, 'subject_id');
    }
    //---------


    // SCOPES
    public function scopeGetSubjectBySlug($query, $slug)
    {
        return $query->where('slug->ar', $slug)
            ->orWhere('slug->en', $slug);
    }

    function scopeGetSubjectByLevel($query, $user)
    {
        return $query->whereHas('level', function ($query) use ($user) {
            $query->where('level_id', $user->studentLevelWithClasses->level_id);
        });
    }

    // -----------

    // normal function
    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }

    // ---------
}