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
                    <h3 class="title-section">Información</h3>
                    <hr>
                    @if (Auth::user()->profile_type == "familiar" && isset($familiar))
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Tu relación con Él/Ella</h4>
                                <p>{{ $familiar->relation }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h4>Etapa en la que estás</h4>
                                <p>{{ $familiar->step }}</p>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if (Auth::user()->profile_type == "professional" && isset($professional))
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Especialidad</h4>
                                <p>{{ $professional->getSpeciallity()->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h4>Categoría</h4>
                                <p>{{ $professional->category }}</p>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if (Auth::user()->profile_type !== "professional")
                        <h4>
                            {{ Auth::user()->profile_type == "familiar" ? 'Sus formas de Comunicación' : 'Formas de comunicación' }}
                        </h4>
                        <div class="row communication_type">
                            @foreach($deaf as $d)
                                @if ($d->communication_type()->get()[0]["name"] == "Implante Coclear")
                                    <div class="col-lg-4 text-center">
                                        <img src="{{ asset('img/implante_coclear.png') }}" alt="" />
                                        <p>
                                            {{ $d->communication_type()->get()[0]["name"] }}
                                        </p>
                                    </div>
                                @endif
                                @if ($d->communication_type()->get()[0]["name"] == "Audífono")
                                    <div class="col-lg-4 text-center">
                                        <img src="{{ asset('img/audifono.png') }}" alt="" />
                                        <p>
                                            {{ $d->communication_type()->get()[0]["name"] }}
                                        </p>
                                    </div>
                                @endif
                                @if ($d->communication_type()->get()[0]["name"] == "Lengua de Señas")
                                    <div class="col-lg-4 text-center">
                                        <img src="{{ asset('img/lengua_de_senias.png') }}" alt="" />
                                        <p>
                                            {{ $d->communication_type()->get()[0]["name"] }}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <br>
                    @endif

                    <h4>Intereses</h4>
                    <ul class="intereses">
                        @foreach(Auth::user()->interests as $interest)
                            <li>{{ ucfirst($interest->name) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
