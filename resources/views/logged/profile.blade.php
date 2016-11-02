@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="{{ asset(Auth::user()->getAvatarUrl()) }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ Auth()->user()->getFullName() }}
					</div>
					<div class="profile-usertitle-job">
						{{ Auth()->user()->getUsername() }}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
                        <li class="active">
							<a href="{{ url('/my_profile') }}">
							<i class="fa fa-btn fa-user"></i>
							Perfil </a>
						</li>
						<li>
							<a href="{{ url('/settings') }}">
							<i class="fa fa-btn fa-cog"></i>
							Configuración </a>
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
						@if (Auth::user()->profile_type == "familiar")
							<h3 class="pull-left">{{ Auth::user()->getFullName() }} <small>Familiar de Persona con Discapacidad Auditiva</small></h3>
						@elseif (Auth::user()->profile_type == "professional")
							<h3 class="pull-left">{{ Auth::user()->getFullName() }} <small>Profesional del Área</small></h3>
						@else
							<h3 class="pull-left">{{ Auth::user()->getFullName() }} <small>Persona con Discapacidad Auditiva</small></h3>
						@endif
							<a href="{{ route('settings') }}" class="btn btn-default pull-right">Editar</a>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4 class="color_secondary_text">Últimos estados</h4>
						@if (!$statuses->count())
							{{ Auth::user()->name }} aún no ha posteado algo.
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
													<a href="{{ url($status->user->getUsernameUrl()) }}" class="color_secondary_text">{{ $status->user->getFullName() }}</a>
												</h4>
												<p class="color_body_text body_status">{{ $status->body }}</p>
												<ul class="options_of_post">
													<li class="likes">{{ $status->created_at->diffForHumans() }}</li>
													<li class="likes">{{ $status->likes()->count() }} me gusta</li>
												</ul>
												@if (Auth::user()->id == $status->user->id)
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
                @if (Auth::user()->profile_type !== "professional")
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
                @if (Auth::user()->profile_type == "familiar")
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Mi relación</h4>
							<p>{{ $familiar->relation }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Mi etapa</h4>
							<p>{{ $familiar->step }}</p>
                        </div>
                    </div>
                    <hr>
                @elseif (Auth::user()->profile_type == "professional")
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Mi especialidad</h4>
							<p>{{ $speciallity->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="color_secondary_text">Soy</h4>
							<p>{{ $professional->category }}</p>
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
