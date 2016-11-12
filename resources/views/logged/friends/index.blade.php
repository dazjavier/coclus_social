@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Tus amigos</h3>
                                <div class="row">
                                    @if (! Auth::user()->friends()->count())
                                        <div class="col-md-12">
                                            <h4>No tienes amigos por ahora.</h4>
                                        </div>
                                    @else
                                        @foreach($friends as $user)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="ficha">
                                                    <div class="img-container-ficha" style="background-image: url({{ asset($user->getAvatarUrl()) }})"></div>
                                                    <div class="datos">
                                                        <a href="{{ url($user->getUsernameUrl()) }}" class="ficha-name">{{ $user->getFullName() }}</a>
                                                        <p class="ficha-username">{{ $user->getUsername() }}</p>
                                                        @if (Auth::check())
                                                            @if (! Auth::user()->isFriendWith($user))
                                                                <a href="" class="btn btn-small btn-success">Agregar a Amigos</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h4>Solicitudes de Amistad</h4>
                                @if (! $requests->count())
                                    <p>No tienes nuevas solicitudes de amistad.</p>
                                @else
                                    @foreach($requests as $user)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div CLASS="col-md-12">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="{{ url($user->getUsernameUrl()) }}">
                                                                <img src="{{ asset($user->getAvatarUrl()) }}" style="width: 48px; border-radius: 48px;">
                                                            </a>
                                                        </div>
                                                        <div class="media-body media-middle">
                                                            <h4 class="media-heading">
                                                                <a href="{{ url($user->getUsernameUrl()) }}">{{ $user->getFullName() }}</a>
                                                            </h4>
                                                            <div>
                                                                <a href="{{ route('friends.accept', ['username' => $user->getUsername()])  }}" class="btn btn-xs btn-success">Aceptar</a>
                                                                <a href="" class="btn btn-xs btn-danger">Ignorar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
