<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon-01.png') }}" />
    <link rel="stylesheet" href="https://select2.github.io/dist/css/select2.min.css" media="screen" title="no title">

    <title>Coclus - Registrarme</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
</head>
<body class="login">
    <a href="{{ url('/') }}"><img src="{{ asset('img/logo_coclus.png') }}"></a>
    <div class="vertical-form-box-register">
        <h2>Registrarme</h2>
        <form class="vertical-form" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="selec-perfil" style="{{ count($errors) > 0 ? 'display: none;' : '' }}">
                <h4>Selecciona tu Perfil</h4>
                <ul class="perfiles">
                    <li>
                        <button class="unbotonized" data-href="deaf">
                            <img src="{{ asset('img/persona_sorda.png') }}" class="img-responsive center-block" alt="Responsive image">
                            <div>Soy una persona con discapacidad auditiva</div>
                        </button>
                    </li>
                    <li>
                        <button class="unbotonized" data-href="familiar">
                            <img src="{{ asset('img/familia.png') }}" class="img-responsive center-block" alt="Responsive image">
                            <div>Soy familiar de una persona con discapacidad auditiva</div>
                        </button>
                    </li>
                    <li>
                        <button class="unbotonized" data-href="professional">
                            <img src="{{ asset('img/doctor.png') }}" class="img-responsive center-block" alt="Responsive image">
                            <div>Soy un profesional del área</div>
                        </button>
                    </li>
                    <input type="hidden" name="profile_type" value="{{ old('profile_type') }}">
                </ul>

                <button class="btn-login vertical-form-input next-step">Siguiente</button>
            </div>
            <div class="row-register selec-datos" style="{{ count($errors) > 0 ? 'display: block;' : '' }}">
                <h4>Ingresa tus datos personales</h4>

                <input type="text" name="name" placeholder="Nombre" class="vertical-form-input-register" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="error-block">
                        {{ $errors->first('name') }}
                    </span>
                @endif

                <input type="text" name="lastname" placeholder="Apellidos" class="vertical-form-input-register" value="{{ old('lastname') }}">
                @if ($errors->has('lastname'))
                    <span class="error-block">
                        {{ $errors->first('lastname') }}
                    </span>
                @endif

                <input type="text" name="username" placeholder="Nombre de usuario" class="vertical-form-input-register" value="{{ old('username') }}">
                @if ($errors->has('username'))
                    <span class="error-block">
                        {{ $errors->first('username') }}
                    </span>
                @endif

                <input type="email" name="email" placeholder="Correo electrónico" class="vertical-form-input-register" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="error-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                <input type="text" name="address" placeholder="Dirección" class="vertical-form-input-register" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="error-block">
                        {{ $errors->first('address') }}
                    </span>
                @endif

                <select class="vertical-form-input-register select-comuna" name="comuna">
                    <option value="">Selecciona tu comuna</option>
                </select>
                @if ($errors->has('comuna'))
                    <span class="error-block">
                        {{ $errors->first('comuna') }}
                    </span>
                @endif

                <input type="password" name="password" placeholder="Contraseña" class="vertical-form-input-register">
                @if ($errors->has('password'))
                    <span class="error-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif

                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="vertical-form-input-register">
                @if ($errors->has('password_confirmation'))
                    <span class="error-block">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif

                <p class="color_body_text" style="font-size: 13px;">
                    Al dar Siguiente, aceptas los <a href="{{ url('/password/reset') }}" class="login-forgot-link">Términos y Condiciones de Uso</a> de Coclus.
                </p>
                <button class="btn-login vertical-form-input" type="submit">Siguiente</button>
            </div>
        </form>
    </div>
    <div class="modal">
        <img src="{{ asset('img/logo_coclus_text.png') }}" alt="" />
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://select2.github.io/dist/js/select2.full.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
