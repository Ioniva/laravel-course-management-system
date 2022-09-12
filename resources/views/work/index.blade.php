@extends('adminlte::page')

@section('title', 'PHPeros - Work')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Entregas</h1>
                    <a type="button" class="btn btn-primary mt-2" href="/work/create">
                        New Work
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item active">Work</li>
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
                            <h3 class="card-title">Administrar trabajos</h3>
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
                                    <th>Asignatura</th>
                                    <th>Alumno</th>
                                    <th>Tarea</th>
                                    <th>Nota</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($works as $work)
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $work->subject->name }}</td>
                                        <td>{{ $work->user->name .' '. $work->user->surname }}</td>
                                        <td>{{ $work->name }}</td>
                                        <td>{{ $work->mark }}</td>
                                        </td>
                                        <form action="/work/delete/{{$work->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-flat disabled ml-4" href="#">
                                                    <em class="fas fa-folder"></em>
                                                    View
                                                </a>
                                                <a href="/work/edit/{{$work->id}}" type="button"
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
