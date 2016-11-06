@extends('layouts.app')

@section('content')
    <div class="container body-padding">
        <div class="row">
            <div class="col-lg-8">
                <h3>Timeline</h3>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media comment">
                            <div class="media-body">
                                <form action="{{ route('status.post') }}" method="post">
                                    {{ csrf_field() }}
                                    <textarea name="status" placeholder="{{ ucfirst(Auth::user()->name) }}, escribe algo..." class="form-control input-text"></textarea>
                                    @if ($errors->has('status'))
                                        <span class="error-block">
                                            {{ $errors->first('status') }}
                                        </span>
                                    @endif
                                    <br>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-fw fa-comment"></i>
                                        &nbsp; Postear estado
                                    </button>
                                </form>
                            </div>
                            <div class="media-right">
                                <a href="{{ Auth::user()->getUsernameUrl() }}">
                                    <img class="media-object" src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->getFullName() }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (! $statuses->count())
                            <h5>No hay estados publicados aún.</h5>
                        @else
                            @foreach($statuses as $status)
                                @include('logged.comments.comments', ['status' => $status])
                            @endforeach
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 publicidad">
                        <h4>AquaMic™ Headpiece</h4>
                        <h5>The World’s Only Waterproof Cochlear Implant Microphone</h5>
                        <p>The AquaMic is 100% waterproof for uncompromised hearing in and out of the water. Delivering the industry’s only headpiece-integrated microphone, AB allows Naída CI and Neptune™ recipients to wear the processor off the ear in the preferred location for any activity and still have optimal sound quality for outstanding hearing!</p>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <h3>Noticias</h3>
                <hr>
                <div class="col-lg-12">
                    <img src="{{ asset('img/noticia_1.png') }}" alt="Noticia" class="img-responsive" />
                    <img src="{{ asset('img/noticia_2.png') }}" alt="Noticia" class="img-responsive" />
                </div>
            </div>
        </div>
    </div>
@endsection
