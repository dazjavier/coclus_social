@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading">
                        <h3>Resultados</h3>
                        <h5>Buscaste: "{{ request()->input('q') }}"</h5>
                    </div>
                    <div class="panel-body">
                        <h4>Usuarios</h4>
                        <hr>
                        <div class="row">
                            @if (!$users->count())
                                <div class="col-md-12">
                                    <h5>No hay resultados para "{{ request()->input("q") }}"</h5>
                                </div>
                            @else
                                @foreach ($users as $user)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="ficha">
                                            <div class="img-container">
                                                <img src="{{ asset($user->getAvatarUrl()) }}" class="img-responsive img-ficha" alt="">
                                            </div>
                                            <div class="datos">
                                                <a href="{{ url($user->getUsernameUrl()) }}" class="ficha-name">{{ $user->getFullName() }}</a>
                                                <p class="ficha-username">{{ $user->getUsername() }}</p>
                                                @if (Auth::check())
                                                    @if (Auth::user()->hasFriendRequestPending($user))
                                                        <a href="" class="btn btn-sm btn-warning disabled">Solicitud enviada</a>
                                                    @elseif (Auth::user()->hasFriendRequestReceived($user))
                                                        <a href="{{ route('friends.accept', ['username' => $user->getUsername()])  }}" class="btn btn-sm btn-warning">Aceptar solicitud de amistad</a>
                                                    @elseif (Auth::user()->id !== $user->id)
                                                        <a href="{{ route('friends.add', ['username' => $user->getUsername()]) }}" class="btn btn-sm btn-success">Agregar a Amigos</a>
                                                    @else
                                                        <span class="color_body_text">Tú</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
