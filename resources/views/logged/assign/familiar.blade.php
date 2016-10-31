@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->profile_type == strtolower("familiar"))
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Familiar de Persona con Discapacidad Auditiva</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ url('/set_profile/familiar') }}" method="post">
                                    {{ csrf_field() }}
                                    <h4>¿Cuál es tu relación con él?</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
                                                <select class="form-control select" name="relation" value="{{ old('relation') }}">
                                                    <option></option>
                                                    <option {{ old('relation') == "Madre o Padre" ? 'selected' : '' }}>Madre o Padre</option>
                                                    <option {{ old('relation') == "Hermana o Hermano" ? 'selected' : '' }}>Hermana o Hermano</option>
                                                    <option {{ old('relation') == "Tía o Tío" ? 'selected' : '' }}>Tía o Tío</option>
                                                    <option {{ old('relation') == "Abuela o Abuela" ? 'selected' : '' }}>Abuela o Abuela</option>
                                                    <option {{ old('relation') == "Otro" ? 'selected' : '' }}>Otro</option>
                                                </select>
                                                @if ($errors->has('relation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('relation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>¿En qué etapa estás?</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('step') ? ' has-error' : '' }}">
                                                <select class="form-control select" name="step" value="{{ old('step') }}">
                                                    <option></option>
                                                    <option {{ old('step') == "Me acabo de enterar" ? 'selected' : '' }}>Me acabo de enterar</option>
                                                    <option {{ old('step') == "Estoy viviendo la etapa" ? 'selected' : '' }}>Estoy viviendo la etapa</option>
                                                    <option {{ old('step') == "Ya pasé por la etapa" ? 'selected' : '' }}>Ya pasé por la etapa</option>
                                                    <option {{ old('step') == "Otra" ? 'selected' : '' }}>Otra</option>
                                                </select>
                                                @if ($errors->has('step'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('step') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @include('logged.assign.communication_types', array("title_communication_types" => "Selecciona las formas de comunicación de tu familiar"))
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
