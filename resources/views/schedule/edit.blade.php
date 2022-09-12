@extends('adminlte::page')

@section('title', 'PHPeros - Schedule')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Horarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/schedule">Schedule</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-body">

                            <form action="/schedule/update/{{$schedule->id}}" method="post">
                                @csrf
                                @method('PUT')
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="time_start">Start time</label>
                                        <input type="time" id="time_start" name="time_start" class="form-control"
                                               placeholder="Insert the start time" value="{{$schedule->time_start}}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="time_end">End time</label>
                                    <input type="time" id="time_end" name="time_end" class="form-control"
                                           placeholder="Insert the end time" value="{{$schedule->time_end}}">
                                </div>

                                <div class="col-12">
                                    <label for="day">Date</label>
                                    <input type="date" id="day" name="day" class="form-control"
                                           placeholder="Insert the date" value="{{$schedule->day}}">
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/schedule">Close</a>
                                    <button type="submit" class="btn btn-primary" id="btnAction">Add Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
