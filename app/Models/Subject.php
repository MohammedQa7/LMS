<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name', 'slug'];

    public $translatable = ['name' , 'slug'];

    function level() {
        return $this->belongsToMany(Level::class , 'subject_levels');
    }


    public function scopeGetSubjectBySlug($query, $slug)
    {
        return $query->where('slug->ar', $slug)
            ->orWhere('slug->en', $slug);
    }

    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }
}
