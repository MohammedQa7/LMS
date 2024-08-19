<?php

namespace App\Livewire\StudentPromotions;

use App\Models\Classes;
use App\Models\Level;
use App\Models\StudentClass;
use App\Models\StudentPromotions;
use App\Models\Subject;
use App\Models\User;
use App\Traits\NotificationTrait;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PromotionListComponent extends Component implements HasForms
{
    use NotificationTrait;
    use InteractsWithForms;
    public ?array $data = [];
    public $from_level;
    public $from_section;
    public $from_class;
    public $selected_students = [];
    public $selectAllStudents = true;
    function mount()
    {
        $this->form->fill();
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(trans('generalTrans.FilamentSectionTitle.promote-from'))
                    ->schema([
                        Select::make('from_level')
                            ->label(trans('subject-content-modal.zoom-level-field'))
                            ->options(Level::get()
                                ->pluck('name', 'id'))
                            ->live()
                            ->required(),
                        Select::make('from_section')
                            ->label(trans('subject-content-modal.zoom-section-field'))
                            ->options(
                                fn(Get $get): Collection => \App\Models\Section::whereHas('level', function ($query) use ($get) {
                                    $query->where('level_id', $get('from_level'));
                                })->pluck('name', 'id'),
                            )->required(),
                        Select::make('from_class')
                            ->label(trans('subject-content-modal.zoom-class-field'))
                            ->options(
                                fn(Get $get): Collection => Classes::whereHas('sections', function ($query) use ($get) {
                                    $query->where('level_id', $get('from_level'));
                                })->pluck('name', 'id'),
                            )->required(),
                    ])->columns(3),
                Section::make(trans('generalTrans.FilamentSectionTitle.promote-to'))
                    ->schema([
                        Select::make('to_level')
                            ->label(trans('subject-content-modal.zoom-level-field'))
                            ->options(Level::get()
                                ->pluck('name', 'id'))
                            ->live()
                            ->required(),
                        Select::make('to_section')
                            ->label(trans('subject-content-modal.zoom-section-field'))
                            ->options(
                                fn(Get $get): Collection => \App\Models\Section::whereHas('level', function ($query) use ($get) {
                                    $query->where('level_id', $get('to_level'));
                                })->pluck('name', 'id'),
                            )->required(),
                        Select::make('to_class')
                            ->label(trans('subject-content-modal.zoom-class-field'))
                            ->options(
                                fn(Get $get): Collection => Classes::whereHas('sections', function ($query) use ($get) {
                                    $query->where('level_id', $get('to_level'));
                                })->pluck('name', 'id'),
                            )->required(),

                    ])->columns(3),

                Section::make(trans('generalTrans.FilamentSectionTitle.promote-year'))
                    ->schema([
                        TextInput::make('promotion_year')
                            ->label('Year Of Promotion')
                            ->required(),
                    ])

            ])
            ->columns(2)
            ->statePath('data');
    }


    function OpenModalEvent()
    {
        $data = $this->validate();
        if ($this->validate()) {
            $this->from_level = $data['data']['from_level'];
            $this->from_section = $data['data']['from_section'];
            $this->from_class = $data['data']['from_class'];

            $this->dispatch('open-modal', name: "open-student-modal");
        }
    }

    function Promote()
    {
        $data = $this->form->getState();
        $users_to_promote = StudentClass::getAllUsersToPromote($data['from_level'], $data['from_section'], $data['from_class'])->get();
        foreach ($users_to_promote as $single_user) {
            foreach ($this->selected_students as $selected_student_id) {
                if ($selected_student_id == $single_user->user_id) {
                    try {
                        DB::beginTransaction();
                        $single_user->update([
                            'level_id' => $data['to_level'],
                            'section_id' => $data['to_section'],
                            'class_id' => $data['to_class'],
                        ]);

                        StudentPromotions::create([
                            'student_id' => $selected_student_id,
                            'from_level' => $data['from_level'],
                            'from_section' => $data['from_section'],
                            'from_class' => $data['from_class'],
                            'to_level' => $data['to_level'],
                            'to_section' => $data['to_section'],
                            'to_class' => $data['to_class'],
                            'promotion_year' => $data['promotion_year'],
                        ]);
                        DB::commit();
                        $this->success('Student has been promted :) ');
                        $this->dispatch('close-modal');
                        $this->reset();
                    } catch (\Throwable $th) {
                        dd($th);
                        DB::rollBack();
                        $this->failed('Something went wrong while promoting students');
                    }
                }
            }
        }
    }

    #[Computed]
    function StudentsPromotionList()
    {

        $user = User::whereHas('studentLevelWithClasses', function ($query) {
            $query->where('level_id', $this->from_level)
                ->where('section_id', $this->from_section)
                ->where('class_id', $this->from_class);
        })->get();
        // checking the selected users to be promoted
        if (!is_null($this->selectAllStudents) && $this->selectAllStudents) {
            foreach ($user as $single_user) {
                $this->selected_students[] = $single_user->id;
            }
        } else {
            $this->selected_students = [];
        }
        return $user;

    }

    #[Computed]
    function PromotedStudents()
    {
        $promoted_students = StudentPromotions::
            with('student', 'fromLevel', 'fromSection', 'fromClass', 'toLevel', 'toSection', 'toClass')
            ->get();
        return $promoted_students;
    }
    public function render()
    {
        return view('livewire.student-promotions.promotion-list-component');
    }
}