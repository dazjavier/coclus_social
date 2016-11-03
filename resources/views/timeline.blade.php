@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="color_primary_text">Timeline</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('status.post') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <textarea class="form-control" placeholder="{{ ucfirst(Auth::user()->name) }}, escribe algo..." name="status"></textarea>
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Postear" class="btn btn-primary pull-right">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <hr>
                            @if (! $statuses->count())
                                <div class="col-md-12">
                                    <h4 class="color_body_text">No hay estados publicados aún.</h4>
                                </div>
                            @else
                                @foreach($statuses as $status)
                                    <div class="col-md-12">
                                        <div class="media" id="comment_{{ $status->id }}">
                                            <div class="media-left">
                                                <a href="{{ url($status->user->getUsernameUrl()) }}">
                                                    <img class="media-object" style="width: 48px; height: 48px; border-radius: 24px;" src="{{ asset($status->user->getAvatarUrl()) }}" alt="{{ $status->user->getFullName() }}" >
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="{{ url($status->user->getUsernameUrl()) }}" class="color_secondary_text">{{ $status->user->getFullName() }}</a>
                                                </h4>
                                                <p class="color_body_text body_status">{{ $status->body }}</p>
                                                <ul class="options_of_post">
                                                    <li class="likes">{{ $status->created_at->diffForHumans() }}</li>
                                                    <li class="likes">{{ $status->likes()->count() }} me gusta</li>
                                                    @if ($status->user->id !== Auth::user()->id)
                                                        @if (! Auth::user()->hasLikedStatus($status))
                                                            <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Me gusta</a></li>
                                                        @else
                                                            <li><a href="{{ route('status.unlike', ['statusId' => $status->id]) }}">Ya no me gusta</a></li>
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
                                                                <li class="likes">{{ $reply->created_at->diffForHumans() }}</li>
                                                                <li class="likes">{{ $reply->likes()->count() }} me gusta</li>
                                                                @if ($reply->user->id !== Auth::user()->id && Auth::user()->isFriendWith($reply->user))
                                                                    @if (!Auth::user()->hasLikedStatus($reply))
                                                                        <li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Me gusta</a></li>
                                                                    @else
                                                                        <li><a href="{{ route('status.unlike', ['statusId' => $reply->id]) }}">Ya no me gusta</a></li>
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                                <div class="col-lg-12">
                                    {{ $statuses->render() }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h3>Publicidad</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, ad adipisci animi corporis delectus doloremque dolorum ducimus earum eligendi ex exercitationem illum molestiae numquam obcaecati odio pariatur recusandae sed voluptates?
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus hic incidunt libero neque nostrum reiciendis? Animi error esse ex nisi nulla omnis quidem repellendus reprehenderit sequi soluta vel velit, voluptatem!
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, assumenda at, deserunt dolores eaque eum hic impedit, itaque minus modi mollitia natus porro ratione! Alias eum quia quos rerum unde.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
