<?php

namespace App\Livewire\Materials;

use App\Models\Classes;
use App\Models\FileMaterial;
use App\Models\Level;
use App\Models\Material;
use App\Models\Subject;
use App\Models\TeacherTeachingSubject;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Component;

class MaterialListComponent extends Component
{
    use AuthorizesRequests;
    public $material_file_path;


    // recived Class and Subject from controller 
    public $class;
    public $subejct;

    // this is the changed status depending on the user 
    //e.g when the user sets the visibality to a specefic file to ethier true or false, the status variable will hold the id of the file and the status value.
    public $status = [];

    // after getting the material form the computed function i will bind the id of the material to this variable.
    public $current_material;

    // when the teacher  want to restore some of the files this variable will containe all the deleted files for a specific material
    //of course this will happen by calling deletedFiles() function.
    public $deleted_files;
    public function mount($class_slug, $subject_slug)
    {
        $this->material_file_path = public_path() . '/storage/';
        $this->class = Classes::getClassBySlug($class_slug)->first();
        $this->subejct = Subject::getSubjectBySlug($subject_slug)->first();


        // makeing sure that teacher can only access classes that he was assigned to 
        if ($this->class && $this->subejct) {
            $teacher_level_and_classes = TeacherTeachingSubject::where('class_id', $this->class->id)->where('subject_id', $this->subejct->id)->first();
        } else {
            abort(404, 'No Material were found');
        }
        // using the TeacherLevelAndClasses Policy

        if (is_null($teacher_level_and_classes) && Auth::user()->isStudent()) {
            return;
        } else {
            $this->authorize('view', $teacher_level_and_classes);
        }
    }

    #[Computed]
    function Materials()
    {

        if ($this->class && $this->subejct) {
            $material = Material::getMaterialForClassAndSubject($this->class->id, $this->subejct->id)
                ->with([
                    'files' => function ($query) {
                        $query->withoutTrashed();
                        $query->when(Auth::user()->isStudent() , function($query){
                            $query->where('status' , true);
                        });
                    }
                ])
                ->get();

            // getting the file size for each file
            Material::getFileSize($material, $this->material_file_path);

            if ($material) {
                // init the file status for checkbox field
                foreach ($material as $single_material) {
                    foreach ($single_material->files as $single_file) {
                        $this->status[$single_file->id] = $single_file->status;
                    }
                }
                return $material;
            }
        }
    }


    // live updating the status of the file , without refresh or save button.

    public function updating($property, $value)
    {
        if (preg_match('/^status\.(\d+)$/', $property, $matches)) {
            $id = $matches[1];

            $file = FileMaterial::find($id);
            if ($file) {
                $file->update([
                    'status' => $value,
                ]);
            }
            if ($value) {
                Notification::make()
                    ->title('File set to visible')
                    ->color('success')
                    ->success()
                    ->duration(2000)
                    ->send();
            } else {
                Notification::make()
                    ->title('File set to un-visible')
                    ->color('success')
                    ->success()
                    ->duration(2000)
                    ->send();
            }
        }
    }

    function deletedFiles()
    {
        $deleted_files = Material::getMaterialForClassAndSubject($this->class->id, $this->subejct->id)
            ->whereHas('files', function ($query) {
                $query->onlyTrashed();
            })
            ->with(([
                'files' => function ($query) {
                    $query->onlyTrashed();
                }
            ]))
            ->select('id')
            ->get();

        Material::getFileSize($deleted_files, $this->material_file_path);
        // dd($deleted_files->toArray());
        return $this->deleted_files = $deleted_files;
    }


    function delete($file_id)
    {
        $file = FileMaterial::where('id', $file_id)->first();
        if ($file) {
            $file->delete();
            Notification::make()
                ->title('File Deleted Successfully :)')
                ->color('success')
                ->success()
                ->send();
        }
    }

    function restoreFile($file_id)
    {
        $file = FileMaterial::onlyTrashed()->where('id', $file_id);
        if ($file) {
            $this->dispatch('close-modal');
            $file->restore();
            Notification::make()
                ->title('File Restored Successfully')
                ->color('success')
                ->success()
                ->duration(2000)
                ->send();
        } else {
            $this->dispatch('close-modal');
            Notification::make()
                ->title('Something went wrong while restoring your files')
                ->color('danger')
                ->danger()
                ->duration(2000)
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.materials.material-list-component');
    }
}