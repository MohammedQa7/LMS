<?php

namespace App\Livewire\Level;


use App\Helpers\globalFunctionsHelper;
use App\Models\Attendance;
use App\Models\FileMaterial;
use App\Models\Level;
use App\Models\Material;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use App\Traits\NotificationTrait;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;

class TeacherLevelListComponent extends Component
{
    use NotificationTrait;
    use WithFileUploads;
    use WithFilePond;
    public ?array $data = [];
    
    public $selected_tab = '';


    // subject educational content
    // #[Validate('required')]
    // public $name_ar;

    // #[Validate('required')]
    // public $name_en;

    // #[Validate('required|max:1024')]
    // public $subject_content_files = [];

    // public $file_types;

    // #[Validate('required')]
    // public $selected_file_type;

    // #[Validate('required')]
    // public $status = false;


    // attendance data
    public $attendance_students = null;
    // all the students that took thier attendance
    public $attendance_values = [];
    // getting the class id from a hidden input in the attendance modal
    public $class_id_from_attendance;
    public function mount()
    {
        $this->selected_tab =
            Level::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->first()->id ?? null;

        $this->file_types = globalFunctionsHelper::allTypes();
    }
    // getting the tab data so the user will be able to chnage it
    #[Computed]
    function LevelTabs()
    {
        $level = Level::with('user')
            ->whereHas('user', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();
        return $level;
    }
    // changing the tab and the content based on the tab data
    public function SelectTab($tab)
    {
        if (!is_null($tab)) {
            $this->selected_tab = $tab;
        }
    }

    // getting only the classes that the teacher is associated with 
    #[Computed]
    function TeacherLevels()
    {
        $level = TeacherTeachingSubject::with('class', 'subject')
            ->where('user_id', Auth::user()->id)
            ->where('level_id', $this->selected_tab)
            ->get();
        return $level;
    }


    // // saving the materials to specific class
    // function saveSubjectContent($class_id, $subject_id)
    // {
    //     $this->validate();

    //     // this is a gate that points to a policy to check if the current user is assigned to this class and subject
    //     $this->authorize('create-material', [$class_id, $subject_id]);
    //     try {
    //         DB::beginTransaction();
    //         $material = Material::create([
    //             'name' => [
    //                 'ar' => $this->name_ar,
    //                 'en' => $this->name_en,
    //             ],
    //             'subject_id' => $subject_id,
    //             'class_id' => $class_id,
    //         ]);

    //         if ($material) {
    //             foreach ($this->subject_content_files as $single_file) {
    //                 $file_path = $single_file->store('material/files', 'public');
    //                 $files = FileMaterial::create([
    //                     'material_id' => $material->id,
    //                     'file' => $file_path,
    //                     'type' => $this->selected_file_type,
    //                     'status' => $this->status,
    //                 ]);
    //             }
    //         }
    //         DB::commit();
    //         $this->reset('name_ar', 'name_en', 'status', 'selected_file_type');
    //         $this->dispatch('formSubmitted');
    //         $this->dispatch('close-modal');
    //         Notification::make()
    //             ->title('Material Has Been created successfully')
    //             ->color('success')
    //             ->success()
    //             ->icon('heroicon-o-document-text')
    //             ->iconColor('success')
    //             ->duration(5000)
    //             ->send();
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         DB::rollBack();
    //         Notification::make()
    //             ->title('something went wrong while creating material')
    //             ->color('danger')
    //             ->danger()
    //             ->duration(5000)
    //             ->send();
    //     }
    // }

    function StudnetAttendance($class_id)
    {
        if ($class_id) {
            $studnets = User::with([
                'attendances' => function ($query) {
                    $query->where('date', now()->format('Y/m/d'));
                }
            ], 'studentLevelWithClasses')
                ->whereHas('studentLevelWithClasses', function ($query) use ($class_id) {
                    $query->where('class_id', $class_id);
                })
                ->role(User::STUDENT)->get();
            $this->class_id_from_attendance = $class_id;
            $this->attendance_students = $studnets;
        }
    }


    function saveAttendance()
    {
        if (!is_null($this->attendance_values) && sizeof($this->attendance_values) > 0) {
            foreach ($this->attendance_values as $user_id => $attendance_status) {
                $attendance = Attendance::create([
                    'user_id' => $user_id,
                    'teacher_id' => Auth::user()->id,
                    'class_id' => $this->class_id_from_attendance,
                    'date' => now(),
                    'status' => $attendance_status
                ]);
            }
            if ($attendance) {
                $this->dispatch('close-modal');
                Notification::make()
                    ->title('Attendances have been stored')
                    ->color('success')
                    ->success()
                    ->iconColor('success')
                    ->duration(5000)
                    ->send();

                $this->attendance_values = [];
            }
        } else {
            $this->attendance_students->load([
                'attendances' => function ($query) {
                    $query->where('date', now()->format('Y/m/d'));
                }
            ]);
        }

    }

    public function render()
    {
        return view('livewire.level.teacher-level-list-component');
    }
}