@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="/uploads/avatars/{{ $u->avatar }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $u->getFullName() }}
                    </div>
                    <div class="profile-usertitle-job">
                        {{ $u->username }}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{ url('/users/' . strtolower($u->username)) }}">
                                <i class="fa fa-btn fa-user"></i>
                                Perfil </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-btn fa-flag"></i>
                                Ayuda </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>

        <div class="col-md-9">
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($u->profile_type == "familiar")
                            <h3 class="color_primary_text">{{ $u->getFullName() }} <small>Familiar de Persona con Discapacidad Auditiva</small></h3>
                        @elseif ($u->profile_type == "professional")
                            <h3 class="color_primary_text">{{ $u->getFullName() }} <small>Profesional del Área</small></h3>
                        @else
                            <h3 class="color_primary_text">{{ $u->getFullName() }} <small>Persona con Discapacidad Auditiva</small></h3>
                        @endif

                        @if (Auth::check())
                            @if (Auth::user()->hasFriendRequestPending($u))
                                <a href="" class="btn btn-warning disabled"><i class="fa fa-btn fa-user-plus"></i>Solicitud de amistad enviada</a>
                            @elseif (Auth::user()->hasFriendRequestReceived($u))
                                <a href="{{ route('friends.accept', ['username' => $u->getUsername()])  }}" class="btn btn-warning"><i class="fa fa-btn fa-user-plus"></i>Aceptar solicitud de amistad</a>
                            @elseif (Auth::user()->isFriendWith($u))
                                <p class="color_body_text pull-left">Tú y {{ ucfirst($u->name) }} ya son amigos.</p>
                                    <form action="{{ route('friends.delete', ['username' => $u->getUsername()]) }}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" href="" class="btn btn-danger btn-sm pull-right">Eliminar amigo</button>
                                    </form>
                                @if ($u->profile_type == "professional")
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <div>
                                                Evalúa a este Profesional
                                                <ul class="vote">
                                                    @for ($i=1; $i < 6; $i++)
                                                        <li>
                                                            <a href="{{ route('professional.rate', ['professional_id' => $u->id, 'vote' => $i]) }}" class="btn btn-link">
                                                                <i class="fa fa-star"></i>
                                                            </a>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                @endif
                            @elseif (Auth::user()->id != $u->id)
                                <a href="{{ route('friends.add', ['username' => $u->getUsername()]) }}" class="btn btn-warning"><i class="fa fa-btn fa-user-plus"></i>Agregar a Amigos</a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="color_secondary_text">Últimos estados</h4>
                        @if (!$statuses->count())
                            {{ $u->name }} aún no ha posteado algo.
                        @else
                            <div class="row">
                                @foreach($statuses as $status)
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="media" id="comment_{{ $status->id }}">
                                            <div class="media-left">
                                                <a href="{{ url($status->user->getUsernameUrl()) }}">
                                                    <img class="media-object" style="width: 48px; height: 48px; border-radius: 24px;" src="{{ asset($status->user->getAvatarUrl()) }}" alt="{{ $status->user->getFullName() }}" >
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <small class="color_body_text pull-right"></small>
                                                    <a href="{{ url($status->user->getUsernameUrl()) }}" class="color_secondary_text">{{ $status->user->getFullName() }}</a>
                                                </h4>
                                                <p class="color_body_text body_status">{{ $status->body }}</p>
                                                <ul class="options_of_post">
                                                    <li class="likes">{{ $status->created_at->diffForHumans() }}</li>
                                                    @if (Auth::check())
                                                        @if ($status->user->id !== Auth::user()->id)
                                                            <li class="likes">{{ $status->likes()->count() }} me gusta</li>
                                                            @if (!Auth::user()->hasLikedStatus($status))
                                                                <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Me gusta</a></li>
                                                            @else
                                                                <li><a href="{{ route('status.unlike', ['statusId' => $status->id]) }}">Ya no me gusta</a></li>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </ul>
                                                @foreach($status->replies as $reply)
                                                    <div class="media">
                                                        <a href="{{ url($reply->user->getUsernameUrl()) }}" class="pull-left">
                                                            <img src="{{ $reply->user->getAvatarUrl() }}" class="media-object" style="width: 32px;height: 32px;border-radius:16px;" alt="{{ $reply->user->getFullName() }}">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5 class="media-heading">
                                                                <a href="{{ url($reply->user->getUsernameUrl()) }}" class="color_secondary_text">
                                                                    {{ $reply->user->getFullName() }}
                                                                </a>
                                                            </h5>
                                                            <p>{{ $reply->body }}</p>
                                                            <ul class="options_of_post">
                                                                <li class="likes">{{ $reply->user->created_at->diffForHumans() }}</li>
                                                                <li class="likes">{{ $reply->likes()->count() }} me gusta</li>
                                                                @if (Auth::check())
                                                                    @if ($reply->user->id !== Auth::user()->id && Auth::user()->isFriendWith($reply->user))
                                                                        @if (! Auth::user()->hasLikedStatus($reply))
                                                                            <li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Me gusta</a></li>
                                                                        @else
                                                                            <li><a href="{{ route('status.unlike', ['statusId' => $reply->id]) }}">Ya no me gusta</a></li>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if ($authIsFriend)
                                                    <form action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
                                                            <textarea name="reply-{{ $status->id }}" id="reply-{{ $status->id }}" class="form-control" placeholder="Comentar"></textarea>
                                                            @if ($errors->has("reply-{$status->id}"))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first("reply-{$status->id}") }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" value="Comentar" class="btn btn-sm btn-default pull-right">
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                @if ($u->profile_type !== "professional")
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="color_secondary_text">Formas de comunicación</h4>
                            <div class="row">
                                @foreach ($com_types as $type )
                                    @foreach ($type as $t)
                                        <div class="col-md-3">
                                            {{ $t->name }}
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($u->profile_type == "familiar")
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Mi relación</h4>
                            <p>{{ $familiar[0]->relation }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Mi etapa</h4>
                            <p>{{ $familiar[0]->step }}</p>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="color_secondary_text">Intereses</h4>
                    </div>
                    @foreach($interest as $i)
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <p class="color_body_text">{{ ucfirst($i->name) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
