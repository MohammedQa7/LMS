<?php

namespace App\Http\Controllers;


use App\Helpers\fileTypes;
use App\Helpers\globalFunctionsHelper;
use App\Models\Classes;
use App\Models\FileMaterial;
use App\Models\Material;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
   public $material_file_path;
   public function __construct() {
    $this->material_file_path =  public_path() . '/storage/';
   }

    function showSpecificMaterial($class_slug, $subject_slug)
    {
        return view('dashboard-site.Materials.material-list')
        ->with('class_slug' , $class_slug)
        ->with('subject_slug' , $subject_slug);
        // $class = Classes::getClassBySlug($class_slug)->first();
        // $subejct = Subject::getSubjectBySlug($subject_slug)->first();

        // if ($class && $subejct) {
        //     $material = Material::getMaterialForClassAndSubject($class->id, $subejct->id)
        //         ->with('files')
        //         ->get();

                
        //     // getting the file size for each file
        //     Material::getFileSize($material  , $this->material_file_path);
        //     dd($material->toArray());

        //     if ($material) {
        //         return view('dashboard-site.Materials.material-list')->with('material' , $material);
        //     } else {
        //         abort(404, 'No Material were found');
        //     }
        // }
    }

    function download($file_id){
        $file = FileMaterial::find($file_id)->first();
        if ($file) {
            return  Response::download($this->material_file_path  . $file->file);
        }else{
            abort(404 , 'No file were found');
        }
    }
}