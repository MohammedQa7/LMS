<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Event;
use App\Models\Level;
use App\Models\Subject;
use App\Models\TeacherTeachingSubject;
use App\Models\TextEditorTest;
use App\Models\User;
use App\Notifications\CalendarEventsNotifications;
use App\Traits\NotificationTrait;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Whoops\Util\HtmlDumperOutput;

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

    // binding the event title data to this variable after creating an event and then setting the event title to null while this variable keeps it
    public $real_time_calendar_title;


    public $levels;
    public $classes;
    public $subjects;
    // getting the start date of the clicked area on the calendar
    public $start_date;
    // getting the end date of the clicked area on the calendar
    public $end_date;

    public $current_event;

    public $is_event_editable = false;

    public $NotifyStudents = true;


    /* getting the notification data from the notification component and store the data into this variable
     , so when the user clicks at the specific notification 
     we will scroll to the calendar and change the date of the calendar to the notificaion clicked date, and highlight the event.
    */
    public $notificaion_data = null;


    function mount()
    {
        $this->getSelectionData();
        $this->getevent();
    }


    // LISTENERS

    #[On('eventModal')]
    function openModal($start_date, $end_date = null)
    {
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
        $this->is_event_editable = false;
        $this->start_date = $start_date;
        $this->end_date = $end_date ?? null;
        $this->dispatch('open-event-modal');
    }

    #[On('confirmDate')]
    function confirmEvent($event)
    {
        $this->current_event = null;
        $this->current_event = $event;
        $this->dispatch('open-modal', name: 'confirm');
    }

    #[On('NavigateToEvent')]
    function NavigateToEvent($notification_id)
    {
        /*
         escaping the "\\" slashed so we can decode it once and get the data 
        without the code below the data will be returned null when decoding the notificaion data 

        --------------
        use the code below when you recive a set data as json only
        */
        // $jsonString = stripslashes($notification);
        // $notification_data = json_decode($jsonString , true);


        // dispatching an event for the calendar
        if ($notification_id) {
            $this->dispatch('highlightEvent', event_id: $notification_id);
        }
    }

    #[On('EditModal')]
    function editModal($event_id)
    {
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
        if ($event_id) {
            $this->is_event_editable = true;
            $event = Event::where('id', $event_id)->first();
            $this->current_event = $event;
            $this->event_title = $event->title;
            $this->event_description = $event->description;
            $this->selected_time = $event->event_time;
            $this->selected_level = Classes::where('id', $event->class_id)->with('sections')->first()->sections->level_id;
            $this->selected_class = $event->class_id;
            $this->selected_subject = $event->subject_id;
            $this->dispatch('open-event-modal');
        }
    }
    function editEvent($eventData)
    {
        $edited_event = Event::where('id', $eventData['id'])->update([
            'teacher_id' => Auth::user()->id,
            'title' => $this->event_title,
            'description' => $this->event_description,
            'class_id' => $this->selected_class,
            'subject_id' => $this->selected_subject,
            'event_time' => $this->selected_time,
        ]);
        if ($edited_event) {
            if ($this->NotifyStudents) {
                $users = User::whereHas('studentLevelWithClasses', function ($query) {
                    $query->where('class_id', $this->selected_class);
                })->get();
                if ($users) {
                    foreach ($users as $single_user) {
                        $single_user->notify(new CalendarEventsNotifications($eventData['id'], 'Teacher Edited ' . $eventData['title'] . 'Event'));
                        $chat_notification = $single_user
                            ->notifications()
                            ->whereRaw('JSON_EXTRACT(data , "$.event_id") = ? ', $eventData['id'])
                            ->get();
                        foreach ($chat_notification as $single_notifications) {
                            $single_notifications->update([
                                'notification_type' => Event::NOTIFICATIONS_TYPE,
                            ]);
                        }
                    }
                }
            }
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
        }
        $this->dispatch('close-event-modal');
        $this->dispatch('update_calendar', event_id: $eventData['id']);
        $this->success('Event added successfully');
    }
    function deleteEvent($event_id)
    {
        $event = Event::where('id', $event_id)->first();

        if ($event) {
            $event->delete();
            $this->dispatch('close-modal');
            $this->dispatch('close-event-modal');
            $this->dispatch('delete_event', event_id: $event_id);
            $this->success('Event deleted successfully', 'heroicon-o-check', 2000);
            $this->reset();
            $this->getSelectionData();
        } else {
            $this->failed('Something went wrong while trying to delete th event', 'heroicon-o-x-mark', 2000);
        }
    }
    function cancleEvent()
    {

    }


    public function getevent()
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
        return json_encode($events);
    }



    function confirmEventChange()
    {
        if ($this->current_event) {
            $this->dispatch('revertEvent', info: $this->current_event);
        }
        $this->getevent();
    }
    function changeEvent()
    {
        if ($this->current_event) {
            $this->dispatch('changeEvent', info: $this->current_event);
        }
        $this->getevent();
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
            $users = User::whereHas('studentLevelWithClasses', function ($query) {
                $query->where('class_id', $this->selected_class);
            })->get();
            if ($users) {
                foreach ($users as $single_user) {
                    $single_user->notify(new CalendarEventsNotifications($event['id'], 'Teacher setup a new event'));
                    $chat_notification = $single_user
                        ->notifications()
                        ->whereRaw('JSON_EXTRACT(data , "$.event_id") = ? ', $event['id'])
                        ->get();
                    foreach ($chat_notification as $single_notifications) {
                        $single_notifications->update([
                            'notification_type' => Event::NOTIFICATIONS_TYPE,
                        ]);
                    }
                }
            }
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

            $users = User::whereHas('studentLevelWithClasses', function ($query) use ($eventdata) {
                $query->where('class_id', $eventdata['class_id']);
            })->get();
            if ($eventdata) {
                if ($users) {
                    foreach ($users as $single_user) {
                        $single_user->notify(new CalendarEventsNotifications($eventdata['id'], 'Teacher rescheduled an event'));
                        $chat_notification = $single_user
                            ->notifications()
                            ->whereRaw('JSON_EXTRACT(data , "$.event_id") = ? ', $eventdata['id'])
                            ->get();
                        foreach ($chat_notification as $single_notifications) {
                            $single_notifications->update([
                                'notification_type' => Event::NOTIFICATIONS_TYPE,
                            ]);
                        }
                    }
                }

                $this->success('Event Edited successfully', null, 2000);
                $this->dispatch('close-modal', name: 'confirm');
            }
        } else {
            $this->failed('Please refresh the page before you change the position of the event', 'heroicon-o-shield-exclamation', 3000);
        }
    }


    function getSelectionData()
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


        $textEditor = TextEditorTest::get();
        return view('livewire.calendar', [
            'arrayData' => $this->arrayData,
            'textEditor' => $textEditor
        ]);
    }
}