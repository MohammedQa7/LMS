<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classes extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = [
        'name',
        'slug',
        'section_id'
    ];
    public $translatable = ['name', 'slug'];


    // Relationships
    function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    function classAttend()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    //---------

    public function scopeGetClassBySlug($query, $slug)
    {
        return $query->where('slug->ar', $slug)
            ->orWhere('slug->en', $slug);
    }

    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }
}