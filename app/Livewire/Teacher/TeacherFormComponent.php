<?php

namespace App\Livewire\Teacher;

use App\Models\Classes;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherTeachingSubject;
use Faker\Core\Number;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TeacherFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $teacher;
    public function mount($teacher = null): void
    {
        if ($teacher) {
            $this->form->fill($teacher->toArray());
        }else{
            $this->form->fill();
        }
        
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    TextInput::make("name.ar")
                        ->label(
                            'Full Name (Arabic)'
                        )
                        ->required(
                        ),
                    TextInput::make('name.en')
                        ->label(
                            'Full Name (English)'
                        )
                        ->required(
                        ),

                    TextInput::make('email')
                        ->label(
                            'Email'
                        )
                        ->placeholder(
                            'example@gmail.com'
                        )
                        ->required(
                        ),
                    TextInput::make('phone_number')
                        ->label(
                            'Phone Number'
                        )
                        ->numeric(
                        )
                        ->placeholder(
                            '+972599123123123'
                        )
                        ->required(
                        )->maxLength(10),
                    TextInput::make('password')
                        ->label(
                            'Password'
                        )
                        ->password(
                        )
                        ->revealable(
                        )
                        ->placeholder(
                            '*******'
                        )
                        ->required(
                        ),
                    DatePicker::make('date_of_birth')
                        ->label(
                            'Date Of Birth'
                        ),

                    Select::make('gender.ar')
                        ->label(
                            'Gender (Arabic)'
                        )
                        ->options(
                            [
                                'ذكر' => 'ذكر',
                                'انثى' => 'انثى',
                            ]
                        ),
                    Select::make('gender.en')
                        ->label(
                            'Gender (English)'
                        )
                        ->options(
                            [
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ]
                        ),
                    TextInput::make('city.ar')
                        ->label(
                            'City (Arabic)'
                        )
                        ->placeholder(
                            'غزة'
                        )
                        ->required(
                        ),
                    TextInput::make('city.en')
                        ->label(
                            'City (English)'
                        )
                        ->placeholder(
                            'Gaza'
                        )
                        ->required(
                        ),

                    TextInput::make('address.ar')
                        ->label(
                            'Address (Arabic)'
                        )
                        ->placeholder(
                            'غزة'
                        ),
                    TextInput::make('address.en')
                        ->label(
                            'Address (English)'
                        )
                        ->placeholder(
                            'Gaza'
                        ),
                    TextInput::make('id_number')
                        ->label(
                            'ID number'
                        )
                        ->placeholder(
                            '9999999'
                        )
                        ->numeric(
                        )
                        ->required(
                        )->columnSpanFull(
                        ),
                    Repeater::make('teacher_course')
                        ->label(
                            'Teacher Course'
                        )
                        ->schema(
                            [
                                Select::make('level_id')
                                    ->label(
                                        'Associated Level'
                                    )
                                    ->options(
                                        Level::get()->pluck('name', 'id')
                                    )
                                    ->live(
                                    )
                                    ->required(
                                    ),
                                Select::make('class_id')
                                    ->label(
                                        'Associated Class'
                                    )
                                    ->options(
                                        fn(Get $get): \Illuminate\Support\Collection => Classes::whereHas(
                                            'sections', function ($query) use ($get) {
                                                $query->where('level_id', $get('level_id'));
                                            }
                                        )->pluck(
                                                'name',
                                                'id'
                                            )
                                    )
                                    ->required(
                                    ),
                                Select::make('subject_id')
                                    ->label(
                                        'Associated Subject'
                                    )
                                    ->options(
                                        fn(Get $get): Collection => Subject::whereHas(
                                            'level', function ($query) use ($get) {
                $query->where('level_id', $get('level_id'));
            }
                                        )->pluck(
                                                'name',
                                                'id'
                                            )
                                    )
                                    ->required(
                                    ),
                            ]
                        )->columns(
                            3
                        )->columnSpanFull(
                        )
                ]
            )->columns(
                2
            )
            ->statePath(
                'data'
            );
    }
    public function create(): void
    {
        $data = $this->form->getState();
        try {
            DB::beginTransaction();
            $teacher = Teacher::create(
                [
                    'name' => [
                        'ar' => $data['name']['ar'],
                        'en' => $data['name']['en']
                    ],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => Hash::make($data['password']),
                    'date_of_birth' => $data['date_of_birth'],
                    'gender' => [
                        'ar' => $data['gender']['ar'],
                        'en' => $data['gender']['en']
                    ],
                    'city' => [
                        'ar' => $data['city']['ar'],
                        'en' => $data['city']['en'],
                    ],
                    'address' => [
                        'ar' => $data['address']['ar'],
                        'en' => $data['address']['en'],
                    ],
                    'id_number' => $data['id_number']
                ]
            );
            if ($teacher) {
                if (sizeof($data['teacher_course']) > 0 && !is_null($data['teacher_course'])) {
                    foreach ($data['teacher_course'] as $data) {
                        TeacherTeachingSubject::create(
                            [
                                'teacher_id' => $teacher->id,
                                'level_id' => $data['level_id'],
                                'class_id' => $data['class_id'],
                                'subject_id' => $data['subject_id'],
                            ]
                        );
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.teacher.teacher-form-component');
    }
}