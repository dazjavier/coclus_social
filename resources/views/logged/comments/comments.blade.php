<div class="media comment" id="comment_{{ $status->id }}">
    <div class="media-left">
        <a href="{{ url($status->user->getUsernameUrl()) }}">
        <img class="media-object" src="{{ asset($status->user->getAvatarUrl()) }}" alt="{{ $status->user->getFullName() }}">
    </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading title-comment">{{ $status->user->getFullName() }}</h4>
        <p class="body-comment">
            {{ $status->body }}
        </p>
        <ul class="info-comment">
            <li>{{ $status->created_at->diffForHumans() }}</li>
            <li>{{ $status->likes()->count() }} me gusta</li>
            @if (Auth::check())
                @if ($status->user->id !== Auth::user()->id)
                    @if (! Auth::user()->hasLikedStatus($status))
                        <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Me gusta</a></li>
                    @else
                        <li><a href="{{ route('status.unlike', ['statusId' => $status->id]) }}">Ya no me gusta</a></li>
                    @endif
                @endif
                <li><a href="#" class="comment-link {{ $errors->has("reply-{$status->id}") ? 'active' : '' }}">Comentar</a></li>
                <div class="comment-textbox {{ $errors->has("reply-{$status->id}") ? '' : 'reply-status' }}" id="comment_status_{{ $status->id }}">
                    <form action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                        {{ csrf_field() }}
                        <textarea name="reply-{{ $status->id }}" id="reply-{{ $status->id }}" class="form-control input-text"></textarea>
                        @if ($errors->has("reply-{$status->id}"))
                            <span class="error-block">
                                {{ $errors->first("reply-{$status->id}") }}
                            </span>
                        @endif
                        <button type="submit" class="btn btn-primary pull-right">
                            <i class="fa fa-fw fa-commenting"></i>
                            &nbsp; Comentar
                        </button>
                    </form>
                </div>
            @endif
            @if ($status->replies->count())
                @foreach($status->replies as $reply)
                    <div class="media comment reply">
                        <div class="media-left">
                            <a href="{{ url($reply->user->getUsernameUrl()) }}">
                                <img class="media-object" src="{{ $reply->user->getAvatarUrl() }}" alt="{{ $reply->user->getFullName() }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading title-comment">{{ $reply->user->getFullName() }}</h4>
                            <p class="body-comment">
                                {{ $reply->body }}
                            </p>
                            <ul class="info-comment">
                                <li>{{ $reply->created_at->diffForHumans() }}</li>
                                <li>{{ $reply->likes()->count() }} me gusta</li>
                                @if (Auth::check())
                                    @if ($reply->user->id !== Auth::user()->id)
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
            @else
                <h6>Esta publicación no tiene comentarios aún</h6>
            @endif
        </ul>
    </div>
</div>
