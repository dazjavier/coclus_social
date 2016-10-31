@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ol class="breadcrumb">
                <li class="active">Soy</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">Selecciona tu perfil</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url('/set_profile/deaf') }}" class="deaf">Soy una Persona con Discapacidad Auditiva</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('/set_profile/familiar') }}" class="familiar">Familiar de persona con Discapacidad Auditiva</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('/set_profile/professional') }}" class="professional">Profesional del Área</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
