<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon-01.png') }}" />

    <title>Coclus - Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
</head>
<body class="login">
    <a href="{{ url('/') }}"><img src="{{ asset('img/logo_coclus.png') }}"></a>
    <div class="vertical-form-box">
        <h2>Iniciar sesión</h2>
        <form class="vertical-form" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div>
                <input type="email" placeholder="Correo electrónico" class="vertical-form-input" name="email" value="{{ old('email') }}" id="email">
                @if ($errors->has('email'))
                    <span class="error-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div>
                <input type="password" placeholder="Contraseña" class="vertical-form-input" name="password" id="password">
                @if ($errors->has('password'))
                    <span class="error-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <input type="submit" value="Iniciar sesión" class="btn-login vertical-form-input">
        </form>
        <a href="{{ url('/password/reset') }}" class="login-forgot-link">¿Olvidaste tu contraseña?</a>
    </div>

    <p class="register-link">
        ¿No tienes cuenta aún? <a href="{{ url('/register') }}">Regístrate</a>
    </p>
</body>
</html>
