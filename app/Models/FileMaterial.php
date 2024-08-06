<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMaterial extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable =[
        'material_id','file' ,'type' ,'status'
    ];


    function material(){
        return $this->belongsTo(Material::class);
    }
    
}
