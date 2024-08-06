<?php

namespace App\Models;

use App\Helpers\globalFunctionsHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Material extends Model
{
    use HasFactory, HasTranslations , SoftDeletes;

    protected $fillable = [
        'name',
        'class_id',
        'subject_id',
    ];
    public $translatable = ['name'];
    function files()
    {
        return $this->hasMany(FileMaterial::class);
    }


    function scopeGetMaterialForClassAndSubject($query, $class_id, $subject_id)
    {
        return $query->where('class_id', $class_id)
            ->where('subject_id', $subject_id);
    }


    public static function getFileSize($material , $material_file_path)
    {
        return $material->map(function ($material) use ($material_file_path) {
            $material->files->map(function ($single_file) use ($material_file_path) {
                // Perform some transformation on each $material
                if (File::exists($material_file_path . $single_file->file)) {
                    $single_file->file_size = globalFunctionsHelper::humanReadableFileSize(File::size($material_file_path . $single_file->file));
                    $single_file->original_file_name = basename($single_file->file);

                }
            });
        });
    }
}