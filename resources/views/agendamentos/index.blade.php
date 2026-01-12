@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent" style="max-width: 1200px; width: 95%;">
        <h2>Agendamentos</h2>
        <div id="calendar"></div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'pt-br',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia',
                list: 'Lista'
            },
            height: 'auto',
            slotMinTime: '07:00:00',
            slotMaxTime: '22:00:00',
            // events: [] // Aqui você poderá carregar os eventos do backend futuramente
        });
        calendar.render();
    });
</script>

<style>
    /* Adaptação do FullCalendar para o tema escuro */
    :root {
        --fc-border-color: rgba(255, 255, 255, 0.1);
        --fc-button-text-color: var(--md-sys-color-on-primary);
        --fc-button-bg-color: var(--md-sys-color-primary);
        --fc-button-border-color: var(--md-sys-color-primary);
        --fc-button-hover-bg-color: var(--md-sys-color-secondary);
        --fc-button-hover-border-color: var(--md-sys-color-secondary);
        --fc-button-active-bg-color: var(--md-sys-color-secondary);
        --fc-button-active-border-color: var(--md-sys-color-secondary);
        --fc-today-bg-color: rgba(208, 188, 255, 0.1);
    }

    .fc .fc-toolbar-title {
        color: var(--md-sys-color-on-surface);
    }

    .fc th.fc-col-header-cell {
        background-color: var(--md-sys-color-primary);
    }

    .fc .fc-col-header-cell-cushion {
        color: var(--md-sys-color-on-primary);
        padding: 12px 4px; /* Aumenta a altura */
        text-decoration: none;
    }

    .fc .fc-daygrid-day-number,
    .fc .fc-timegrid-slot-label-cushion {
        color: var(--md-sys-color-on-surface);
        text-decoration: none;
    }

    .fc .fc-timegrid-axis {
        visibility: hidden;
    }
    
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: var(--fc-border-color);
    }
</style>
@endsection