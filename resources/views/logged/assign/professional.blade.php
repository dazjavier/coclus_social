@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->profile_type == strtolower("professional"))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profesional del Área</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('/set_profile/professional') }}" method="post">
                                        {{ csrf_field() }}
                                        <h4>¿Cuál es tu especialidad?</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('speciallity') ? ' has-error' : '' }}">
                                                    <select name="speciallity" class="form-control">
                                                        <option value=""></option>
                                                        @foreach($speciallities as $speciallity)
                                                            <option value="{{ $speciallity->id }}" {{ old('speciallity') == "{$speciallity->id}" ? 'selected' : '' }}>{{ $speciallity->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('speciallity'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('speciallity') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>¿Empresa o independiente?</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                                    <select class="form-control select" name="category" value="{{ old('category') }}">
                                                        <option></option>
                                                        <option {{ old('category') == "Empresa" ? 'selected' : '' }}>Empresa</option>
                                                        <option {{ old('category') == "Independiente" ? 'selected' : '' }}>Independiente</option>
                                                        <option {{ old('category') == "Otra" ? 'selected' : '' }}>Otro</option>
                                                    </select>
                                                    @if ($errors->has('category'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('category') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @include('logged.assign.interests')
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group pull-right">
                                                    <button type="submit" href="{{ url('/set_profile/familiar') }}" class="btn btn-primary btn-lg">Terminar registro</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <h3>Al parecer no habías seleccionado este tipo de perfil.</h3>
                            <a href="{{ url('/set_profile/' . Auth::user()->profile_type ) }}" class="btn btn-primary btn-sm text-center">Ir a mi tipo de Perfil</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
