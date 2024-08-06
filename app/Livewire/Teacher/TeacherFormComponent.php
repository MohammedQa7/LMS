<?php

namespace App\Livewire\Teacher;

use App\Models\Classes;


use App\Models\Level;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
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
use Filament\Notifications\Notification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class TeacherFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $isEditable = false;

    // the user that we recived from teacher/user Controller (which is the one we are editing)
    public $teacher;
    // all of the previous courses that was assigned to this user
    public $existing_courses = [];
    // all of the new and same courses that needs to be edting or the same is it was before
    public $selected_courses = [];

    // reciveing all of the levels classes and subjects so we can show all of them is a selection option.
    public $levels;
    public $classes;
    public $subjects;


    public function mount($teacher = null): void
    {

        if ($teacher) {
            // Fill the form fields with existing data
            $this->levels = Level::get();
            $this->classes = Classes::with('sections')->get();
            $this->subjects = Subject::with('level')->get();

            // fetching the existing and previous courses
            $this->existing_courses = TeacherTeachingSubject::with('level', 'class', 'subject')
                ->where('user_id', $teacher->id)
                ->get();


            // initiate the selected_courses with the existing data so when we use wire:model the data will auto bind it at the input, and to recive any new data the user choose
            foreach ($this->existing_courses as $key => $value) {
                /* using this [key][level] allows us from livewire to bind the data using wire:model 
                 because wire:model dose not allow us to bind data to nasted arrays or multi level array */
                $this->selected_courses[$key]['level'] = $value->level->id;
                $this->selected_courses[$key]['class'] = $value->class->id;
                $this->selected_courses[$key]['subject'] = $value->subject->id;


            }
            $this->form->fill($teacher->toArray());
            $this->isEditable = true;
        } else {
            $this->form->fill();
        }
    }



    public function rules()
    {
        return [
            'selected_courses.*.level' => 'required',
            'selected_courses.*.class' => 'required',
            'selected_courses.*.subject' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'selected_courses.*.level.required' => trans('custom-validation.custom.selected_courses.level.required'),
            'selected_courses.*.level.exists' => trans('custom-validation.custom.selected_courses.level.exists'),
            'selected_courses.*.class.required' => trans('custom-validation.custom.selected_courses.class.required'),
            'selected_courses.*.class.exists' => trans('custom-validation.custom.selected_courses.class.exists'),
            'selected_courses.*.subject.required' => trans('custom-validation.custom.selected_courses.subject.required'),
            'selected_courses.*.subject.exists' => trans('custom-validation.custom.selected_courses.subject.exists'),
        ];
    }


    // watching any changes that happen to the level key in the selected_course to make whatever we want
    public function updating($property, $value)
    {
        if (preg_match('/^selected_courses\.(\d+)\.level$/', $property, $matches)) {
            $index = $matches[1];
            // $this->selected_courses[$index]['class'] = null;
            // $this->selected_courses[$index]['subject'] = null;
            if (isset($this->selected_courses[$index])) {
                $this->selected_courses[$index] = [
                    'level' => null,
                    'class' => null,
                    'subject' => null,
                ];
            }
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
                    ignorable: $this->teacher
                ),
                TextInput::make('phone_number')->label('Phone Number')->placeholder('+972599123123123')->required()->maxLength(30),
                TextInput::make('password')->label('Password')->password()->revealable()->placeholder('*******')->required(),
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
                TextInput::make('id_number')->label('ID number')->placeholder('9999999')->numeric()->required()->columnSpanFull(),
                Repeater::make('teacher_course')
                    ->label('Teacher Course')
                    ->schema([
                        Select::make('level_id')->label('Associated Level')->options(Level::get()->pluck('name', 'id'))->live()->required(),
                        Select::make('class_id')
                            ->label('Associated Class')
                            ->options(
                                fn(Get $get): \Illuminate\Support\Collection => Classes::whereHas('sections', function ($query) use ($get) {
                                    $query->where('level_id', $get('level_id'));
                                })->pluck('name', 'id'),
                            )
                            ->required(),
                        Select::make('subject_id')
                            ->label('Associated Subject')
                            ->options(
                                fn(Get $get): Collection => Subject::whereHas('level', function ($query) use ($get) {
                                    $query->where('level_id', $get('level_id'));
                                })->pluck('name', 'id'),
                            )
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->defaultItems(3),
            ])
            ->columns(2)
            ->statePath('data');
    }
    public function submit()
    {
        $this->validate();
        dd($this->selected_courses);
        $data = $this->form->getState();
        try {
            DB::beginTransaction();
            $teacher_data = [
                'name' => [
                    'ar' => $data['name']['ar'],
                    'en' => $data['name']['en'],
                ],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => Hash::make($data['password']),
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
                'id_number' => $data['id_number'],
            ];

            $role = Role::where('name', 'teacher')->where('guard_name', 'web')->first();
            if (!$role) {
                $role = Role::create(['name' => 'teacher']);
            }

            $teacher = $this->isEditable ? $this->teacher->update($teacher_data) : User::create($teacher_data)->assignRole($role->name);

            if ($teacher) {
                if (sizeof($data['teacher_course']) > 0 && !is_null($data['teacher_course'])) {
                    foreach ($data['teacher_course'] as $data) {
                        TeacherTeachingSubject::create([
                            'user_id' => is_bool($teacher) ? $this->teacher->id : $teacher->id,
                            'level_id' => $data['level_id'],
                            'class_id' => $data['class_id'],
                            'subject_id' => $data['subject_id'],
                        ]);
                    }
                }
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
        return view('livewire.teacher.teacher-form-component');
    }
}