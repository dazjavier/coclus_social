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
                    <h3 class="title-section">Estados</h3>
                    <hr>
                    <h4>Últimos estados de {{ Auth::user()->getFullName() }}</h4>
                    <br>
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
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
