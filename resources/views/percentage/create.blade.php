@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Percentage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/percentage">Percentage</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="content">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status')  !== null }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-body">

                            <form action="/percentage/store" method="post">
                                @csrf
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                <div class="col-6">
                                        <label for="courses_id">Curso</label>
                                        <select name="courses_id" class="form-control">
                                            @foreach($percentages['courses'] as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="subjects_id">Asignatura</label>
                                        <select name="subjects_id" class="form-control">
                                            @foreach($percentages['subjects'] as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="continuous_assessment">Evaluacion continua (%)</label>
                                        <input type="number" id="continuous_assessment" name="continuous_assessment" class="form-control"
                                               placeholder="Insert the percentage">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="exams">Examen (%)</label>
                                        <input type="number" id="exams" name="exams" class="form-control"
                                               placeholder="Insert the number of exams">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/percentage">Close</a>
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
