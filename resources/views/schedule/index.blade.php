@extends('adminlte::page')

@section('title', 'PHPeros - Schedule')
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 container-header">
                    <h1>Horarios</h1>
                    <a type="button" class="btn btn-primary mt-2" href="/schedule/create">
                        New Schedule
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                        <li class="breadcrumb-item active">schedule</li>
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
                            <h3 class="card-title">Administrar horarios</h3>
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
                                    <th>Hora de inicio</th>
                                    <th>Hora de fin</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$schedule->time_start}}</td>
                                        <td>{{$schedule->time_end}}</td>
                                        <td>{{$schedule->day}}</td>
                                        </td>
                                        <form action="/schedule/delete/{{$schedule->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-flat disabled ml-4" href="#">
                                                    <em class="fas fa-folder"></em>
                                                    View
                                                </a>
                                                <a href="/schedule/edit/{{$schedule->id}}" type="button"
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
