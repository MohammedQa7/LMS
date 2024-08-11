<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{
    use HasFactory , HasTranslations;

    protected $guarded = [
        'id',
        'created_at',
    ];

    public $translatable = ['title', 'description'];
}