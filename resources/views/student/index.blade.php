@extends('adminlte::page')

@section('title', 'PHPeros - Alumnos')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Alumnos</h1>
                    <a type="button" class="btn btn-primary mt-2" href="/student/create">
                        New Student
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item active">Student</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Administrar alumnos</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                           placeholder="Buscar...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Username</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>NIF/NIE/CIF</th>
                                    <th>Fecha de registro</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->surname}}</td>
                                        <td>{{$student->username}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->telephone}}</td>
                                        <td>{{$student->nif}}</td>
                                        <td>{{$student->created_at}}</td>
                                        </td>
                                        <form action="/student/delete/{{$student->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-flat disabled ml-4" href="#">
                                                    <em class="fas fa-folder"></em>
                                                    View
                                                </a>
                                                <a href="/student/edit/{{$student->id}}" type="button"
                                                   class="btn btn-info btn-flat ml-4">
                                                    <em class="fas fa-pencil-alt"></em>
                                                    Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-flat ml-4"
                                                        id="btn-delete">
                                                    <em class="fas fa-trash"></em>
                                                    Delete
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
