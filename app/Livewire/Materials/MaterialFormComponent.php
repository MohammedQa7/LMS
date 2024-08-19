<?php

namespace App\Livewire\Materials;

use App\Helpers\globalFunctionsHelper;
use App\Models\FileMaterial;
use App\Models\LectureSection;
use App\Models\Material;
use App\Services\MaterialsService;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;

class MaterialFormComponent extends Component
{
    use NotificationTrait;
    use WithFileUploads;
    use WithFilePond;
    //  subject educational content
    public $name_ar;
    public $name_en;
    public $subject_content_files = [];
    public $file_types;
    public $selected_file_type;
    public $status = false;

    // Leacture Fields And Data
    public $lecture_name_ar;
    public $lecture_name_en;
    public $videoFiles;
    public $video_url;
    public $lecture_status = false;
    // public $status = false;
    public $selected_lecture_section;

    // Leacture Section Fields And Data
    public $lecture_section_name_ar;
    public $lecture_section_name_en;

    // this controls the visibility of the filepond uploader
    public $is_upload_disabled = false;

    public $activeTab;
    public $current_level;
    // getting all the section that belong to this class and subject
    public $LectureSections;
    protected MaterialsService $materialService;
    function mount($current_level)
    {
        // setting init value for tabs
        $this->activeTab = 'files';
        // getting file types
        $this->file_types = globalFunctionsHelper::allTypes();

    }

    // live updating fields and disable them (video url and video file ).
    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property === 'video_url') {
            // setting the videoFiles into empty array
            $this->videoFiles = [];
            // this controls the visibility of the filepond uploader
            $this->is_upload_disabled = true;
            if ($this->video_url == '') {
                $this->is_upload_disabled = false;
            }
        }

    }


    // saving the materials to specific class
    function submit(MaterialsService $materialsService)
    {
        // this is a gate that points to a policy to check if the current user is assigned to this class and subject
        $this->authorize('create-material', [$this->current_level->class_id, $this->current_level->subject_id]);


        if ($this->activeTab == 'files') {
            // FILE
            $validatedData = $this->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
                'subject_content_files' => 'required|max:1024',
                'selected_file_type' => 'required',
                'status' => 'required',
            ]);
            if ($validatedData) {
                $materialsService->FileSubmit($this->name_ar, $this->name_en, $this->subject_content_files, $this->selected_file_type, $this->status, $this->current_level);
                $this->dispatch('formSubmitted');
                $this->dispatch('close-custom-modal');
            }
        } else if ($this->activeTab == 'lectures') {
            // LEACTURE

            $validatedData = $this->validate([
                'lecture_name_ar' => 'required',
                'lecture_name_en' => 'required',
                'videoFiles' => ['max:1024', Rule::requiredIf(is_null($this->video_url))],
                'video_url' => [Rule::requiredIf(is_null($this->videoFiles))],
                'selected_lecture_section' => 'required',
                'lecture_status' => 'required',
            ]);


            if ($validatedData) {
                $Lecture = $materialsService->LectureSubmit($this->lecture_name_ar, $this->lecture_name_en, $this->videoFiles, $this->video_url, $this->lecture_status, $this->selected_lecture_section);
                if ($Lecture) {
                    $this->is_upload_disabled = false;
                    $this->reset('lecture_name_ar', 'lecture_name_en', 'videoFiles', 'video_url', 'lecture_status', 'selected_lecture_section');
                    $this->dispatch('close-custom-modal');
                    return $this->success('Lecture Section Has Been created successfully', 'heroicon-o-square-3-stack-3d', 5000);
                } else {
                    $this->reset('lecture_name_ar', 'lecture_name_en', 'videoFiles', 'video_url', 'lecture_status', 'selected_lecture_section');
                    $this->dispatch('close-custom-modal');
                    $this->failed('Something went wrong while creating Lecture Section', 'heroicon-o-square-3-stack-3d', 5000);
                }
            }
        }
    }

    function createLectureSection(MaterialsService $materialsService)
    {
        $validatedData = $this->validate([
            'lecture_section_name_ar' => 'required',
            'lecture_section_name_en' => 'required',
        ]);


        if ($validatedData) {
            $lectureSection = $materialsService->createLectureSection($this->current_level, $this->lecture_section_name_ar, $this->lecture_section_name_en);
            if ($lectureSection) {
                $this->reset('lecture_section_name_ar');
                $this->reset('lecture_section_name_en');
                $this->dispatch('close-inner-modal');
                return $this->success('Lecture Section Has Been created successfully', 'heroicon-o-square-3-stack-3d', 5000);
            } else {
                $this->reset('lecture_section_name_ar');
                $this->reset('lecture_section_name_en');
                $this->dispatch('close-inner-modal');
                $this->failed('Something went wrong while creating Lecture Section', 'heroicon-o-square-3-stack-3d', 5000);
            }
        }
    }

    #[Computed]
    function lectureSections()
    {
        if ($this->current_level) {
            $lecture_sections = LectureSection::where('class_id', $this->current_level->class_id)
                ->where('subject_id', $this->current_level->subject_id)->get();
            return $lecture_sections;
        }
    }

    #[On('update_tab')]
    function activeTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function render()
    {
        return view('livewire.materials.material-form-component');
    }
}