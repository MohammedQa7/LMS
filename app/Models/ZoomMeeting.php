<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at'
    ];


    // Relationships
    function class ()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    // 




    // SCOPES
    function scopeSpecificMeeting($query, $class_id, $subejct_id)
    {
        return $query->where('class_id', $class_id)
            ->where('subject_id', $subejct_id);
    }
    // 
}