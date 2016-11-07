@extends('layouts.app')

@section('content')
<div class="container body-padding">
    <div class="row">
        @include('users.sidebar', ['user' => $user])
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">&nbsp;</div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $user->getFullName() }} <small>{{ $user->getUserWhoIs() }}</small></h2>
                </div>
                <div class="col-md-12">
                    @if (Auth::check())
                        @if (Auth::user()->hasFriendRequestPending($user))
                            <a href="" class="btn btn-warning disabled"><i class="fa fa-btn fa-user-plus"></i>Solicitud de amistad enviada</a>
                        @elseif (Auth::user()->hasFriendRequestReceived($user))
                            <a href="{{ route('friends.accept', ['username' => $user->getUsername()])  }}" class="btn btn-warning"><i class="fa fa-btn fa-user-plus"></i>Aceptar solicitud de amistad</a>
                        @elseif (Auth::user()->isFriendWith($user))
                            <p class="color_body_text pull-left">Tú y {{ ucfirst($user->name) }} ya son amigos.</p>
                                <form action="{{ route('friends.delete', ['username' => $user->getUsername()]) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" href="" class="btn btn-danger btn-sm pull-right">Eliminar amigo</button>
                                </form>
                            @if ($user->profile_type == "professional")
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div>
                                            Evalúa a este Profesional
                                            <ul class="vote">
                                                @for ($i=1; $i < 6; $i++)
                                                    <li>
                                                        <a href="{{ route('professional.rate', ['professional_id' => $user->id, 'vote' => $i]) }}" class="btn btn-link">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(! (int) $user_type->averageRating == 0)
                                            <h6>Estrellas: {{ (int) $user_type->averageRating }}/5 </h6>
                                            <hr>
                                        @else
                                            <h6>Este Profesional no tiene votos aún</h6>
                                            <hr>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @elseif (Auth::user()->id != $user->id)
                            <a href="{{ route('friends.add', ['username' => $user->getUsername()]) }}" class="btn btn-warning"><i class="fa fa-btn fa-user-plus"></i>Agregar a Amigos</a>
                        @endif
                    @endif
                </div>
                <div class="col-md-12">
                    <h3 class="title-section">Información</h3>
                    <hr>
                    @if ($user->profile_type == "familiar" && isset($familiar))
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Relación con Él/Ella</h4>
                                <p>{{ $familiar->relation }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h4>Etapa en la que está</h4>
                                <p>{{ $familiar->step }}</p>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if ($user->profile_type == "professional" && isset($user_type))
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Especialidad</h4>
                                <p>{{ $user_type->getSpeciallity()->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h4>Categoría</h4>
                                <p>{{ $user_type->category }}</p>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if ($user->profile_type !== "professional")
                        <h4>
                            {{ $user->profile_type == "familiar" ? 'Sus formas de Comunicación' : 'Formas de comunicación' }}
                        </h4>
                        <div class="row communication_type">
                            @foreach($user_type as $d)
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
                        @foreach($user->interests as $interest)
                            <li>{{ ucfirst($interest->name) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
