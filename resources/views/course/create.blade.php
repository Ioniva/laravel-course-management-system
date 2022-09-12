@extends('adminlte::page')

@section('title', 'PHPeros - Course')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Cursos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/course">Course</a></li>
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

                            <form action="/course/store" method="post">
                                @csrf
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Insert the name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description" class="form-control" placeholder="Insert the description">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="date_start">Start date</label>
                                        <input type="date" id="date_start" name="date_start" class="form-control">
                                    </div>

                                    <div class="col-6">
                                        <label for="date_end">End date</label>
                                        <input type="date" id="date_end" name="date_end" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-1">
                                        <label for="active">Active</label>
                                        <input type="checkbox" id="active" name="active" class="form-control">
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/course">Close</a>
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
