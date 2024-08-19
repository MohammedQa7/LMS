<?php

namespace App\Livewire\Students;

use App\Models\Classes;


use App\Models\Level;
use App\Models\Section;
use App\Models\StudentClass;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class StudentFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $isEditable;

    // the user that we recived from teacher/user Controller (which is the one we are editing)
    public $student;

    // reciveing all of the levels classes and subjects so we can show all of them is a selection option.
    public $levels;
    public $classes;
    public $sections;

    // new selected data will be binded to these variables
    #[Validate('required|exists:levels,id')]
    public $selected_level;

    #[Validate('required|exists:classes,id')]
    public $selected_class;

    #[Validate('required|exists:sections,id')]
    public $selected_section;


    public function mount($student = null): void
    {
        if ($student) {

            // Fill the form fields with existing data
            $this->levels = Level::get();
            $this->classes = Classes::with('sections')->get();
            $this->sections = Section::with('level')->get();

            // fetching the existing and previous courses
            $this->selected_level = $student->studentLevelWithClasses->level_id;
            $this->selected_class = $student->studentLevelWithClasses->class_id;
            $this->selected_section = $student->studentLevelWithClasses->section_id;


            // fetching all the data to filament form
            $this->form->fill($student->toArray());
            $this->isEditable = true;
        } else {
            $this->form->fill();
        }
    }

    // watching any changes that happen to the level key in the selected_course to make whatever we want
    public function updating($property, $value)
    {
        if (preg_match('/^selected_level$/', $property, $matches)) {
            $this->selected_class = null;
            // $this->selected_courses[$index]['class'] = null;
            // $this->selected_courses[$index]['subject'] = null;
            // $this->reset(['selected_courses'.[$index].'class']);
        }
    }




    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name.ar')->label('Full Name (Arabic)')->required(),
                TextInput::make('name.en')->label('Full Name (English)')->required(),

                TextInput::make('email')->label('Email')->placeholder('example@gmail.com')->required()->unique(
                    table: User::class,
                    ignorable: $this->student
                ),
                TextInput::make('phone_number')->label('Phone Number')->placeholder('+972599123123123')->required()->maxLength(30),
                TextInput::make('password')->label('Password')->password()->revealable()->placeholder('*******')->requiredIf($this->isEditable, false)->disabled($this->isEditable),
                DatePicker::make('date_of_birth')->label('Date Of Birth')->native(false)->suffixIcon('heroicon-s-calendar'),

                Select::make('gender.ar')
                    ->label('Gender (Arabic)')
                    ->options([
                        'ذكر' => 'ذكر',
                        'انثى' => 'انثى',
                    ]),

                Select::make('gender.en')
                    ->label('Gender (English)')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
                TextInput::make('city.ar')->label('City (Arabic)')->placeholder('غزة')->required(),
                TextInput::make('city.en')->label('City (English)')->placeholder('Gaza')->required(),

                TextInput::make('address.ar')->label('Address (Arabic)')->placeholder('غزة'),
                TextInput::make('address.en')->label('Address (English)')->placeholder('Gaza'),

                \Filament\Forms\Components\Section::make()
                    ->schema([
                        Select::make('level_id')
                            ->label('Associated Level')
                            ->options(Level::get()
                                ->pluck('name', 'id'))
                            ->live()
                            ->required()
                            ->visible(!$this->isEditable),
                        Select::make('section_id')
                            ->label('Associated Section')
                            ->required()
                            ->visible(!$this->isEditable)
                            ->options(
                                fn(Get $get): \Illuminate\Support\Collection => Section::whereHas('level', function ($query) use ($get) {
                                    $query->where('level_id', $get('level_id'));
                                })->pluck('name', 'id')
                            ),
                        Select::make('class_id')
                            ->label('Associated Class')
                            ->options(
                                fn(Get $get): \Illuminate\Support\Collection => Classes::whereHas('sections', function ($query) use ($get) {
                                    $query->where('level_id', $get('level_id'));
                                })->pluck('name', 'id'),
                            )
                            ->required()->visible(!$this->isEditable),
                    ])->columns(3)->visible(!$this->isEditable),


                FileUpload::make('profile_photo_path')
                    ->disk('public')
                    ->directory('user/avatar')
                    ->label('Avatar Photo')
                    ->avatar(),
            ])


            ->columns(2)
            ->statePath('data');
    }
    public function submit()
    {
        $this->isEditable
            ? $this->validate()
            : '';

        $data = $this->form->getState();

        try {
            DB::beginTransaction();
            $student_data = [
                'name' => [
                    'ar' => $data['name']['ar'],
                    'en' => $data['name']['en'],
                ],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => isset($data['password'])
                ?
                Hash::make($data['password'])
                : '',
                'date_of_birth' => $data['date_of_birth'],
                'gender' => [
                    'ar' => $data['gender']['ar'],
                    'en' => $data['gender']['en'],
                ],
                'city' => [
                    'ar' => $data['city']['ar'],
                    'en' => $data['city']['en'],
                ],
                'address' => [
                    'ar' => $data['address']['ar'],
                    'en' => $data['address']['en'],
                ],
                'profile_photo_path' => $data['profile_photo_path'],
                'id_number' => null,
            ];


            // deletting the password field from the data array if we are editing the user.
            if ($this->isEditable) {
                unset($student_data['password']);
            }

            $role = Role::where('name', 'student')->where('guard_name', 'web')->first();
            if (!$role) {
                $role = Role::create(['name' => 'student']);
            }

            $student = $this->isEditable
                ? $this->student->update($student_data)
                : User::create($student_data)->assignRole($role->name);

            if (is_bool($student) && $this->isEditable) {
                $student_class = StudentClass::where('user_id', $this->student->id)->first();
                if ($student_class) {
                    $student_class->update([
                        'level_id' => $this->selected_level,
                        'class_id' => $this->selected_class,
                        'section_id' => $this->selected_section,
                    ]);
                }
            } else {
                StudentClass::create([
                    'user_id' => is_bool($student) ? $this->student->id : $student->id,
                    'level_id' => $data['level_id'],
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                ]);

            }
            DB::commit();
            $this->isEditable ? '' : $this->reset();

            Notification::make()->title('Saved successfully')->success()->iconColor('success')->duration(5000)->send();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            Notification::make()->title('Something went wrong')->color('danger')->danger()->iconColor('success')->duration(5000)->send();
        }
    }

    public function render()
    {
        return view('livewire.students.student-form-component');
    }
}