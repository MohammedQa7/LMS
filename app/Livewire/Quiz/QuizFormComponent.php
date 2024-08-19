<?php

namespace App\Livewire\Quiz;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class QuizFormComponent extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    // public $isEditable;

    // quiz will be associated with the provided class
    public $class_id;
    public $subject_id;
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()->schema([
                    // left side
                    Fieldset::make('Quiz general information')
                        ->schema([
                            TextInput::make('title.ar')
                                ->label('Title (Arabic)'),
                            TextInput::make('title.en')
                                ->label('Title (English)'),

                            TextInput::make('description.ar')
                                ->label('Description (Arabic)'),
                            TextInput::make('description.en')
                                ->label('Description (English)'),
                        ])->columnSpan(2),

                    Fieldset::make('Question Management')
                        ->schema([
                            Repeater::make('question')
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            TextInput::make('question_text')
                                                ->label('The Question')->columnSpan(2),

                                            TextInput::make('question_score')
                                                ->label('Question Score')
                                                ->helperText('make sure the total score of the questions is the same and the total score for the quiz')
                                                ->numeric()
                                                ->minValue(1)
                                                ->required()
                                                ->columnSpan(1),
                                        ]),

                                    Repeater::make('answers')
                                        ->schema([
                                            TextInput::make('answer_text')
                                                ->label('Answers')
                                                ->columnSpan(2),
                                            Checkbox::make('is_correct')
                                                ->label('Is Correct ?')

                                                ->columnSpan(1),
                                        ])->columns(3)->collapsible()
                                ])->columnSpanFull()->collapsible()
                        ]),



                ])->columnSpan(2),
                // right side 
                Fieldset::make('Quiz Settings')
                    ->schema([
                        TextInput::make('attempts')
                            ->label('Attempts')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        TimePicker::make('time_limit')
                            ->label('Time Limit')
                            ->native(false)
                            ->required(),

                        TextInput::make('total_score')
                            ->label('Overall Score')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        DateTimePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->native(false),
                        DateTimePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->native(false),
                    ])->columns(1)->columnSpan(1),

            ])->columns(3)
            ->statePath('data');
    }

    public function submit()
    {

        $data = $this->form->getState();

        $quiz_data = [
            'title' => [
                'ar' => $data['title']['ar'],
                'en' => $data['title']['en'],
            ],
            'description' => [
                'ar' => $data['description']['ar'],
                'en' => $data['description']['en'],
            ],
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
            'attempts' => $data['attempts'],
            'time_limit' => $data['time_limit'],
            'total_score' => $data['total_score'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ];
        try {

            DB::beginTransaction();
            // creating the quiz
            $quiz = Quiz::create($quiz_data);
            if ($quiz) {
                foreach ($data['question'] as $single_question) {
                    $question = Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => $single_question['question_text'],
                        'score' => $single_question['question_score'],
                    ]);
                    foreach ($single_question['answers'] as $single_answer) {
                        $answer = Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $single_answer['answer_text'],
                            'is_correct' => $single_answer['is_correct'],
                        ]);
                    }
                }
            }
            DB::commit();
            $this->reset();
            Notification::make()
                ->title('Quiz Created Successfully')
                ->success()
                ->color('success')
                ->duration(2000)
                ->send();
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make()
                ->title('Something went wrong while creating the quiz, please make sure that every value is correct :0')
                ->danger()
                ->color('danger')
                ->duration(4000)
                ->send();
        }
    }
    public function render()
    {
        return view('livewire.quiz.quiz-form-component');
    }
}