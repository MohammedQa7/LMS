<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Event;
use App\Models\Level;
use App\Models\Subject;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Calendar extends Component
{
    use NotificationTrait;
    public $events = '';

    #[Validate('required')]
    public $event_title = '';
    public $event_description = '';
    #[Validate('required')]
    public $selected_level;
    #[Validate('required')]
    public $selected_class;
    #[Validate('required')]
    public $selected_subject;
    #[Validate('required')]
    public $selected_time;

    // binding the event title data to this variable after creating an event the then setting the event title to null while this variable keeps it
    public $real_time_calendar_title;


    public $levels;
    public $classes;
    public $subjects;
    public $start_date;
    public $end_date;


    function mount()
    {
        $this->levels = Level::with('user')->whereHas('user', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        $this->classes = Classes::with('user')->whereHas('user', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        $this->subjects = Subject::with('user')->whereHas('user', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
    }
    public function getevent()
    {
        $events = Event::select('id', 'title', 'description', 'event_time', 'start', 'end')
            ->when(!Auth::user()->isStudent(), function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->when(Auth::user()->isStudent(), function ($query) {
                dd('test');
            })
            ->get();
        return json_encode($events);
    }


    #[On('eventModal')]
    function openModal($start_date, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date ?? null;
        $this->dispatch('open-event-modal');
    }

    public function addevent()
    {
        $this->validate();
        $event = Event::create([
            'teacher_id' => Auth::user()->id,
            'title' => $this->event_title,
            'description' => $this->event_description,
            'class_id' => $this->selected_class,
            'subject_id' => $this->selected_subject,
            'event_time' => $this->selected_time,
            'start' => $this->start_date,
            'end' => $this->end_date ?? null,
        ]);
        if ($event) {
            $this->real_time_calendar_title = $this->event_title;
            $this->reset(
                'event_title',
                'event_description',
                'selected_level',
                'selected_class',
                'selected_subject',
                'selected_time',
                'start_date',
                'end_date'
            );
            $this->dispatch('close-event-modal');
            $this->dispatch('real_calendar');
            $this->success('Event added successfully');
        }
    }


    public function eventDrop($event, $oldEvent, $end_event_date)
    {
        if (isset($event['id'])) {
            $eventdata = Event::find($event['id']);
            $eventdata->start = $event['start'];
            $eventdata->end = $end_event_date;
            $eventdata->save();
        } else {
            $this->failed('Please refresh the page before you change the position of the event', 'heroicon-o-shield-exclamation', 3000);
        }
    }


    public function render()
    {
        $student = User::where('id', Auth::user()->id)
            ->with('studentLevelWithClasses')
            ->role('Student')
            ->first();
        $events = Event::select('id', 'title', 'description', 'event_time', 'start', 'end')
            ->when(!Auth::user()->isStudent(), function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->when(Auth::user()->isStudent(), function ($query) use ($student) {
                $query->where('class_id', $student->studentLevelWithClasses->class_id);
            })
            ->get();

        $this->events = json_encode($events);
        return view('livewire.calendar');
    }
}