<div>
    <div x-data="{ modelOpen: false }">
        <div id='calendar-container ' wire:ignore>
            <div id='calendar' class="mt-20"></div>
        </div>
        <x-dashboard.calendar.event-modal></x-dashboard.calendar.event-modal>
    </div>


    @if (Auth::user()->isStudent())
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
                        console.log(info.event);

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
                calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
            });
        </script>
    @else
        <script>
            document.addEventListener('livewire:initialized', function() {
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

                    eventClick: function(info) {
                        console.log(info.event.end);

                    },
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
                    drop: function(info) {


                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },


                    eventDrop: info => @this.eventDrop(info.event, info.oldEvent , info.event.end),
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
                calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
            });
        </script>
    @endif
</div>
