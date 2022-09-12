@extends('adminlte::page')

@section('title', 'PHPeros - Subject')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Clases</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/subject">Subject</a></li>
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

                            <form action="/subject/update/{{$selectedSubject->id}}" method="post">
                                @csrf
                                @method('PUT')
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="users_id">Seleccionar el profesor</label>
                                        <select name="users_id" class="form-control">
                                            @foreach($subjects['teachers'] as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                        @selected($selectedSubject->users_id == $teacher->id)>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="courses_id">Seleccionar el curso </label>
                                        <select name="courses_id" class="form-control">
                                            @foreach($subjects['courses'] as $course)
                                                <option value="{{ $course->id }}"
                                                        @selected($selectedSubject->courses_id == $course->id)>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="schedules_id">Seleccionar horario (F.Inicio/F.Fin/Día)</label>
                                        <select name="schedules_id" class="form-control">
                                            @foreach($subjects['schedule'] as $schedule)
                                                <option value="{{ $schedule->id }}"
                                                        @selected($selectedSubject->schedules_id == $schedule->id)>
                                                    {{ $schedule->time_start }} / {{ $schedule->time_end }} / {{ $schedule->day }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Insert the phone name" value="{{$selectedSubject->name}}">
                                    </div>
                                    <div class="col-6">
                                        <label for="color">Color</label>
                                        <input type="color" id="color" name="color" class="form-control"
                                               value="{{$selectedSubject->color}}">
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/subject">Close</a>
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
