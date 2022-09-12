@extends('adminlte::page')

@section('title', 'PHPeros - Teacher')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Profesores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/teacher">Teacher</a></li>
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

                            <form action="/teacher/update/{{$teacher->id}}" method="post">
                                @csrf
                                @method('PUT')
                                <p class="primary-text">Todos los campos son obligatorios.</p>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Insert the name" value="{{$teacher->name}}">
                                    </div>
                                    <div class="col-6">
                                        <label for="surname">Surname</label>
                                        <input type="text" id="surname" name="surname" class="form-control"
                                               placeholder="Insert the surname" value="{{$teacher->surname}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control"
                                               placeholder="Insert the username" value="{{$teacher->username}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               placeholder="Insert the email" value="{{$teacher->email}}">
                                        <small class="form-text text-muted">We will never share your email</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="telephone">Phone</label>
                                        <input type="number" id="telephone" name="telephone" class="form-control"
                                               placeholder="Insert the phone number" value="{{$teacher->telephone}}">
                                    </div>
                                    <div class="col-6">
                                        <label for="nif">CIF/NIF/NIE</label>
                                        <input type="text" id="nif" name="nif" class="form-control"
                                               placeholder="Insert the surname" value="{{$teacher->nif}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="Insert the password" required>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a type="button" class="btn btn-default" href="/teacher">Close</a>
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
