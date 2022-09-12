@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Seleccionar cursos</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <form action="/home/assign" action="POST">
                            @csrf
                            <p>Selecciona los cursos en los que estas matriculado.</p>
                            <p><b>Nota:</b> Se pueden seleccionar mas de una.</p>
                                    <div class="input-group-text bg-gradient-red">
                                        <i class="fas fa-lg fa-school"></i>
                                        <select name="courses[]" id="courses" multiple="multiple">
                                        
                                        @foreach($courses as $course)
                                        <option value="{{$course->name}}">{{$course->name}}</option>
                                        @endforeach
                                        
                                        </select>
                    </div>
                            <button type="submit" class="btn btn-primary" id="btnAction">Save Changes</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
