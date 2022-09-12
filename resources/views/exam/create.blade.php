@extends('adminlte::page')

@section('title', 'PHPeros - Exam')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Examenes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/exam">Exam</a></li>
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

                            <form action="/exam/store" method="post">
                                @csrf
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="users_id">Seleccionar el alumno</label>
                                        <select name="users_id" class="form-control">
                                            @foreach($exams['students'] as $student)
                                                <option
                                                    value="{{ $student->id }}">{{ $student->name . ' ' . $student->surname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="subjects_id">Seleccionar la asignatura </label>
                                        <select name="subjects_id" class="form-control">
                                            @foreach($exams['subjects'] as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Insert the name of work">
                                    </div>
                                    <div class="col-6">
                                        <label for="mark">Nota (0 - 10)</label>
                                        <input type="number" min="0" max="10" step="0.01" id="mark" name="mark"
                                               class="form-control" placeholder="Insert the work mark">
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/exam">Close</a>
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
