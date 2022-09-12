@extends('adminlte::page')

@section('title', 'Calendar')
@section('content_header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item active">Calendar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
@section('plugins.FullCalendar', true)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,dayGridDay',
                        center: 'title'
                    },
                    initialView: 'dayGridMonth',
                    events: [
                        @foreach($events as $event)

                        {
                            title: '{{ $event['title'] }}',
                            start: '{{ $event['start'] }}',
                            end: '{{ $event['end'] }}',
                            color: '{{ $event['color'] }}'
                        },
                        @endforeach
                    ]
                })
            ;
            calendar.render();
        });
    </script>
@stop
