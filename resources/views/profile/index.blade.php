@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin:0">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/calendar">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- About Me Box -->
                <div class="col-xl-3 col-md-12 col-sm-12 card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong></em> Nombre y apellidos</strong>
                        <p class="text-muted">
                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </p>
                        <hr>

                        @if(Auth::user()->role == 'student')
                            <strong>Username</strong>
                            <p class="text-muted">
                                {{ Auth::user()->username }}
                            </p>
                            <hr>
                        @endif

                        <strong>Email</strong>
                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>
                        <hr>

                        @if(in_array(Auth::user()->role, ['student', 'teacher']))
                            <strong>Teléfono</strong>
                            <p class="text-muted">
                                {{ Auth::user()->telephone }}
                            </p>
                            <hr>
                            <strong>NIF/CIF/NIE</strong>
                            <p class="text-muted">
                                {{ Auth::user()->nif }}
                            </p>
                            <hr>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-xl-9 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#settings"
                                       data-toggle="tab">Cuenta</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="settings">
                                    <form action="/profile/update/{{ Auth::user()->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <p class="primary-text">Todos los campos son obligatorios.</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       placeholder="Insert the name"
                                                       value="{{ Auth::user()->name }}">
                                            </div>
                                            @if(in_array(Auth::user()->role, ['student', 'teacher']))
                                                <div class="col-6">
                                                    <label for="surname">surname</label>
                                                    <input type="text" id="surname" name="surname"
                                                           class="form-control" placeholder="Insert the surname"
                                                           value="{{ Auth::user()->surname }}">
                                                </div>
                                            @endif
                                        </div>

                                        @if(Auth::user()->role == 'student')
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" name="username"
                                                           class="form-control" placeholder="Insert the username"
                                                           value="{{ Auth::user()->username }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                       placeholder="Insert the email"
                                                       value="{{ Auth::user()->email }}">
                                                <small class="form-text text-muted">We will never share your
                                                    email</small>
                                            </div>
                                        </div>

                                        @if(in_array(Auth::user()->role, ['student', 'teacher']))
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="telephone">Phone</label>
                                                    <input type="tel" id="telephone" name="telephone"
                                                           class="form-control"
                                                           placeholder="Insert the phone number"
                                                           value="{{ Auth::user()->telephone }}">
                                                </div>

                                                <div class="col-6">
                                                    <label for="nif">CIF/NIF/NIE</label>
                                                    <input type="text" id="nif" name="nif" class="form-control"
                                                           placeholder="Insert the surname"
                                                           value="{{ Auth::user()->nif }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-6 mb-4">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password"
                                                       class="form-control" placeholder="Insert the password"
                                                       require>
                                            </div>
                                        </div>

                                        @if(Auth::user()->role == 'student')
                                            <p class="primary-text">Opciones para recicibir notificaciones</p>
                                            <div class="row">
                                                <div class="col-6 mb-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="work" name="work"
                                                               @checked(!empty($notification->work) == 1)
                                                        >
                                                        <label for="work" class="custom-control-label">
                                                            Tareas entregadas
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="exam" name="exam"
                                                               @checked(!empty($notification->exam) == 1)
                                                        >
                                                        <label for="exam" class="custom-control-label">
                                                            Exámenes entregadas
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 mb-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="continuous_assessment" name="continuous_assessment"
                                                               @checked(!empty($notification->continuous_assessment) ==
                                                        1)
                                                        >
                                                        <label for="continuous_assessment" class="custom-control-label">
                                                            Evaluación continua
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="final_note" name="final_note"
                                                               @checked(!empty($notification->final_note) == 1)
                                                        >
                                                        <label for="final_note" class="custom-control-label">
                                                            Notas finales
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="modal-footer justify-content-between">
                                            <a type="button" class="btn btn-default" data-dismiss="modal"
                                                    href="/calendar">
                                                Close
                                            </a>
                                            <button type="submit" class="btn btn-primary" id="btnAction"><span
                                                    id="btnText">Update changes</span></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
