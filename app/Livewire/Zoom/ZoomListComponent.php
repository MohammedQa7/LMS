<?php

namespace App\Livewire\Zoom;

use App\Models\Classes;
use App\Models\Level;
use App\Models\Subject;
use App\Models\ZoomMeeting;
use App\Traits\NotificationTrait;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Grid;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jubaer\Zoom\Facades\Zoom;
use Livewire\Component;

class ZoomListComponent extends Component implements HasForms
{
    use NotificationTrait;
    use InteractsWithForms;

    public ?array $data = [];
    // all of the new and same courses that needs to be edting or the same is it was before
    public $selected_courses = [];

    // all the meetings in the database (we got it from controller)
    public $meetings;
    function mount($meetings)
    {
        $this->form->fill();
    }



    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(trans('subject-content-modal.zoom-title-field'))
                    ->required(),
                DateTimePicker::make('start_date')
                    ->label(trans('subject-content-modal.zoom-start-date-field'))
                    ->native(false)
                    ->suffixIcon('heroicon-o-calendar')
                    ->required(),
                TextInput::make('duration')
                    ->label(trans('subject-content-modal.zoom-duration-field'))
                    ->hint(trans('subject-content-modal.zoom-duration-minutes-field'))
                    ->numeric()
                    ->suffixIcon('heroicon-o-clock')
                    ->maxValue(40)
                    ->required(),
                TextInput::make('password')
                    ->label(trans('subject-content-modal.zoom-password-field'))
                    ->password()
                    ->revealable()
                    ->required(),

                Select::make('level_id')
                    ->label(trans('subject-content-modal.zoom-level-field'))
                    ->options(Level::get()
                        ->pluck('name', 'id'))
                    ->live()
                    ->required(),
                Select::make('class_id')
                    ->label(trans('subject-content-modal.zoom-class-field'))
                    ->options(
                        fn(Get $get): Collection => Classes::whereHas('sections', function ($query) use ($get) {
                            $query->where('level_id', $get('level_id'));
                        })->pluck('name', 'id'),
                    )->required(),
                Select::make('subject_id')
                    ->label(trans('subject-content-modal.zoom-subject-field'))
                    ->options(
                        fn(Get $get): Collection => Subject::whereHas('level', function ($query) use ($get) {
                            $query->where('level_id', $get('level_id'));
                        })->pluck('name', 'id'),
                    )->required(),
          

            ])
            ->columns(2)
            ->statePath('data');
    }

    function submit()
    {
        $data = $this->form->getState();
        try {
            DB::beginTransaction();
            $meeting = Zoom::createMeeting([
                "agenda" => $data['title'],
                "topic" => $data['title'],
                "type" => 2,
                // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
                "duration" => $data['duration'],
                // in minutes
                "timezone" => 'Asia/Jerusalem',
                // set your timezone
                "password" => $data['password'],
                "start_time" => Carbon::parse($data['start_date'], 'Asia/Jerusalem'), // set your start time

            ]);
            if ($meeting) {
                $zoom_meeting = ZoomMeeting::create([
                    'meeting_id' => $meeting['data']['id'],
                    'title' => $data['title'],
                    'class_id' => $data['class_id'],
                    'subject_id' => $data['subject_id'],
                    'start_at' => $data['start_date'],
                    'duration' => $meeting['data']['duration'],
                    'meeting_url' => $meeting['data']['join_url'],
                    'start_url' => $meeting['data']['start_url'],
                ]);
            }

            DB::commit();
            $this->dispatch('close-modal');
            $this->success('Meeting Has Been Created');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $this->failed('Something went wrong while creating your meeting, please try again');
        }
    }
    function delete($meeting_id)
    {
        $meeting = Zoom::getMeeting($meeting_id);
        try {
            DB::beginTransaction();
            $deleted_zoom_meeting = Zoom::deleteMeeting($meeting_id);
            if ($deleted_zoom_meeting) {
                $deleted_zoom_meeting_from_table = ZoomMeeting::where('meeting_id', $meeting_id);
                $deleted_zoom_meeting_from_table->delete();
                $this->success('Meeting Has Been deleted');
                DB::commit();
            } else {
                dd('test');
                DB::rollBack();
                $this->failed('Something went wrong while deleting your meeting, please try again');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->failed('Something went wrong while deleting your meeting, please try again');

        }

    }

    public function render()
    {
        return view('livewire.zoom.zoom-list-component');
    }
}