<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id','level_id','class_id'
    ];

    function student()  {
        return $this->belongsTo(User::class);
    }

    function level()  {
        return $this->belongsTo(Level::class);
    }

    function class()  {
        return $this->belongsTo(Classes::class);
    }
}
