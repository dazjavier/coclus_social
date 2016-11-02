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
						<li>
							<a href="{{ url('/my_profile') }}">
							<i class="fa fa-btn fa-user"></i>
							Perfil </a>
						</li>
						<li  class="active">
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
                        <h3>Opciones de Perfil</h3>
                        <div class="row">
                            <form method="post" action="{{ route('settings.post.perfil') }}">
                                {{ csrf_field() }}
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" name="name" placeholder="Nombre" class="form-control" value="{{ old('name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <input type="text" name="lastname" placeholder="Apellidos" class="form-control" value="{{ old('lastname') }}" />
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" name="email" placeholder="Correo elctrónico" class="form-control" value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <input type="text" name="address" placeholder="Dirección" class="form-control" value="{{ old('address') }}" />
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="btnSubmitProfileSettings" value="Guardar cambios" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h3>Cambiar contraseña</h3>
                        <div class="row">
                            <form method="post" action="{{ route('settings.post.password') }}">
                                {{ csrf_field() }}
                                <div class="col-md-12 form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                    <input type="password" name="oldPassword" placeholder="Contraseña actual" class="form-control" />
                                    @if ($errors->has('oldPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oldPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
                                    <input type="password" name="newPassword" placeholder="Nueva contraseña" class="form-control" />
                                    @if ($errors->has('newPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('newPassword_confirmation') ? ' has-error' : '' }}">
                                    <input type="password" name="newPassword_confirmation" placeholder="Confirmar nueva contraseña" class="form-control" />
                                    @if ($errors->has('newPassword_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newPassword_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="btnSubmitChangePassword" value="Guardar cambios" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h3>Cambiar imágen de Perfil</h3>
                        <div class="row">
                            <form method="post" action="{{ route('settings.post.avatar') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-6 form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                    <input type="file" name="avatar">
                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="btnSubmitChangeAvatar" value="Guardar cambios" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
