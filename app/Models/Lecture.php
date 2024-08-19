<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lecture extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [
        'id',
        'created_at'
    ];
    public $translatable = ['name'];


    // Relationships
    // 
}