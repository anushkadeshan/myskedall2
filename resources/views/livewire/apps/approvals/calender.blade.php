
<div>
    <div class="container" wire:ignore>
        <div class="response"></div>
        <div id='calendar'></div>
    </div>
</div>
@push('js')

<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src='{{asset("assets/js/fullcalander.js")}}'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data =   @this.events;
            var calendar = new Calendar(calendarEl, {
            locale: '{{ Config::get('app.locale') }}',
            events: JSON.parse(data),
            displayEventTime: false,
            backgroundColor: 'red',
            eventColor: '#378006',
            editable: false,
            selectable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
            loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
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

@endpush
