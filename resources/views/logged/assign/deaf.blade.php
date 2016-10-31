@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->profile_type == strtolower("deaf"))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Soy Persona con Discapacidad Auditiva</div>
                        <div class="panel-body">
                           <div class="row">
                               <div class="col-md-12">
                                   <form action="{{ url('/set_profile/deaf') }}" method="post">
                                       {{ csrf_field() }}
                                       @include('logged.assign.communication_types', array("title_communication_types" => "Selecciona tus formas de comunicación"))
                                       <hr>
                                       @include('logged.assign.interests')
                                       <hr>
                                       <div class="row">
                                           <div class="col-md-12">
                                               <div class="form-group pull-right">
                                                   <button type="submit" href="{{ url('/set_profile/deaf') }}" class="btn btn-primary btn-lg">Terminar registro</button>
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
