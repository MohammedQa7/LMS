<div id="calendar-section">
    <div x-data="{ modelOpen: false }">
        <div id='calendar-container' wire:ignore>
            <div id='calendar' class="mt-20"></div>
        </div>
        <x-dashboard.calendar.event-modal></x-dashboard.calendar.event-modal>

        <x-confirm-date-modal name="confirm"></x-confirm-event-modal>

    </div>


    @if (Auth::user()->isStudent())
        {{-- STUDENT --}}
        <script>
            document.addEventListener('livewire:initialized', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data = @this.events;
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    displayEventTime: false,
                    eventContent: function(info) {
                        // Create a container for the event content
                        // console.log(info.event);

                        let container = document.createElement('div');
                        container.classList.add('w-full');

                        // Create a div for the title
                        let title = document.createElement('div');
                        title.classList.add('fc-event-title');
                        title.innerText = info.event.title;

                        // Create a div for the description
                        let description = document.createElement('div');
                        description.classList.add('fc-event-description');
                        description.innerText = info.event.extendedProps.description ?? '';

                        // Create a div for the start time
                        let time = document.createElement('div');
                        time.classList.add('fc-event-time');
                        time.innerText = info.event.extendedProps.event_time ?? '';


                        // Append each div to the container
                        container.appendChild(title);
                        container.appendChild(description);
                        container.appendChild(time);

                        // Return the container with the custom content
                        return {
                            domNodes: [container]
                        };
                    },


                });

                Livewire.on('highlightEvent', function(event_id) {
                    if (event_id) {
                        let event = calendar.getEventById(event_id.event_id);
                        calendar.gotoDate(event.start);
                        event.setProp('classNames', ['bg-orange-100', 'border', 'border-orange-600',
                            'transition-all'
                        ]);
                        setInterval(() => {
                            event.setProp('classNames', ['transition-all'])
                        }, 3200);
                    }
                })
                calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
            });
        </script>
    @else
        {{-- TEACHER --}}
        <script>
            document.addEventListener('livewire:initialized', function() {
                // -----
                console.log('test');

                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data = @this.events;
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true, // this allows things to be dropped onto the calendar
                    selectable: true,
                    dateClick(info) {

                        var start_date = new Date(info.dateStr + 'T00:00:00');

                        Livewire.dispatch('eventModal', {
                            'start_date': start_date
                        })
                        Livewire.on('real_calendar', function() {
                            calendar.addEvent({
                                title: @this.real_time_calendar_title,
                                start: date,
                                allDay: true
                            });
                        })
                    },

                    // CLICK
                    eventClick: function(event) {
                        console.log(event);

                        Livewire.dispatch('EditModal', {
                            'event_id': event.event.id
                        })
                    },

                    // SELECT
                    select: function(info) {
                        var start_date = new Date(info.startStr + 'T00:00:00');
                        var end_date = new Date(info.endStr + 'T00:00:00');
                        Livewire.dispatch('eventModal', {
                            'start_date': start_date,
                            'end_date': end_date
                        })

                        Livewire.on('real_calendar', function() {
                            calendar.addEvent({
                                title: @this.real_time_calendar_title,
                                start: start_date,
                                end: end_date,
                                allDay: true
                            });
                        })
                    },

                    // EVENT CONTENT
                    eventContent: function(info) {
                        // Create a container for the event content

                        let container = document.createElement('div');
                        container.classList.add('w-full');

                        // Create a div for the title
                        let title = document.createElement('div');
                        title.classList.add('fc-event-title');
                        title.innerText = info.event.title;

                        // Create a div for the description
                        let description = document.createElement('div');
                        description.classList.add('fc-event-description');
                        description.innerText = info.event.extendedProps.description ?? '';

                        // Create a div for the start time
                        let time = document.createElement('div');
                        time.classList.add('fc-event-time');
                        time.innerText = info.event.extendedProps.event_time ?? '';


                        // Append each div to the container
                        container.appendChild(title);
                        container.appendChild(description);
                        container.appendChild(time);

                        // Return the container with the custom content
                        return {
                            domNodes: [container]
                        };
                    },

                    // DROP
                    drop: function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },


                    // DROPED
                    // eventDrop: info => @this.eventDrop(info.event, info.oldEvent , info.event.end),
                    eventDrop: function(event) {
                        Livewire.dispatch('confirmDate', {
                            'event': event
                        });

                        // getting the droped event and change its date to the original one before the edit , we got the event it self and the info , 
                        Livewire.on('revertEvent', function(info) {
                            event = calendar.getEventById(info.info.event.id);
                            event.setStart(info.info.oldEvent.start);
                            event.setEnd(info.info.oldEvent.end);
                        });
                    },

                    // LOADING
                    loading: function(isLoading) {
                        if (!isLoading) {
                            // Reset custom events
                            this.getEvents().forEach(function(e) {
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });

                /* solving an issue where calling the below code casues the notificaion to pop up as many times as the user changes the event dates
                    or even drop the event anywhere in the calendar
                */
                Livewire.on('changeEvent', function(info) {
                    // this is calling the eventDrop function in Calendar Livewire Component to update the status of the event with the new data.
                    @this.eventDrop(info.info.event, info.info.oldEvent, info.info.event
                        .end);
                })
                // -------------
                // UPDATE THE TITLE WHEN THE TEACHER UPDATE EVENT DATA
                Livewire.on('update_calendar', function(event_id) {
                    if (event_id) {
                        event = calendar.getEventById(event_id.event_id);
                        console.log(event.title);
                        console.log(@this.real_time_calendar_title);

                        event.setProp('title', @this.real_time_calendar_title);
                        console.log(event.title);

                    }
                })

                // DELETING EVENT 
                Livewire.on('delete_event', function(event_id) {
                    if (event_id) {
                        var event = calendar.getEventById(event_id.event_id);
                        event.remove();
                    }
                });

                calendar.render();
                Livewire.on(`refreshCalendar`, () => {
                    calendar.render();
                    calendar.refetchEvents()
                });

            });
        </script>
    @endif
</div>
