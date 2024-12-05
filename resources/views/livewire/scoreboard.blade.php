<div id="calendar" wire:ignore></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('livewire:load');
        Calendar = window.Calendar;
        dayGridPlugin = window.dayGridPlugin;
        timeGridPlugin = window.timeGridPlugin;
        listPlugin = window.listPlugin;
        let scores = @json($scores);

        let calendarEl = document.getElementById('calendar');
        let calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek',

            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste  de la samaine',
            },
            events: scores,
        });
        calendar.render();
    });
</script>
