@extends('layouts.app')

@section('content')
    <div class="container body-padding">
        <div class="row">
            @include('logged.profiles.sidebar')
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">&nbsp;</div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ Auth::user()->getFullName() }} <small>{{ Auth::user()->getUserWhoIs() }}</small></h2>
                    </div>
                    <div class="col-md-12">
                        <h3 class="title-section">Configuración</h3>
                        <hr>
                        <h4>Configuración Personal</h4>
                        <form action="{{ route('settings.post.perfil') }}" role="form" method="post">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-config" placeholder="Nombre" name="name" value="{{ old('name') }}">
                                        @if ($errors->has("name"))
                                            <span class="error-block">
                                                {{ $errors->first("name") }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-config" placeholder="Apellidos" name="lastname" value="{{ old('lastname') }}">
                                        @if ($errors->has("lastname"))
                                            <span class="error-block">
                                                {{ $errors->first("lastname") }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="comuna" class="form-control input-config select-comuna">
                                            <option value="">Selecciona tu Comuna</option>
                                        </select>
                                        @if ($errors->has("comuna"))
                                            <span class="error-block">
                                                {{ $errors->first("comuna") }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn-config input-config">
                                            <i class="fa fa-fw fa-floppy-o"></i>
                                            Guardar cambios
                                        </button>
                                    </div>
                                </div>
                        </form>
                        <br>
                        <h4>Cambiar Contraseña</h4>
                        <form method="post" action="{{ route('settings.post.password') }}" role="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="password" class="form-control input-config" placeholder="Contraseña actual" name="oldPassword">
                                    @if ($errors->has("oldPassword"))
                                        <span class="error-block">
                                            {{ $errors->first("oldPassword") }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control input-config" placeholder="Nueva contraseña" name="newPassword">
                                    @if ($errors->has("newPassword"))
                                        <span class="error-block">
                                            {{ $errors->first("newPassword") }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="password" class="form-control input-config" placeholder="Repite nueva contraseña" name="newPassword_confirmation">
                                    @if ($errors->has("newPassword_confirmation"))
                                        <span class="error-block">
                                            {{ $errors->first("newPassword_confirmation") }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn-config input-config">
                                        <i class="fa fa-fw fa-unlock-alt"></i>
                                        Cambiar contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <h4>Cambiar avatar</h4>
                        <form method="post" action="{{ route('settings.post.avatar') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="file" name="avatar">
                                    @if ($errors->has('avatar'))
                                        <span class="error-block">
                                            {{ $errors->first('avatar') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn-config input-config">
                                        <i class="fa fa-fw fa-cloud-upload"></i>
                                        Subir avatar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
