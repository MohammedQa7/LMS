<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'level_id'
    ];
    public $translatable = ['name', 'slug'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function scopeGetSectionBySlug($query, $slug)
    {
        return $query->where('slug->ar', $slug)
            ->orWhere('slug->en', $slug);
    }

    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }
}
