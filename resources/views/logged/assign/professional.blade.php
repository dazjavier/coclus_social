<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon-01.png') }}" />

    <title>Coclus - Registrarme</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
</head>
<body class="login">
    <a href="{{ url('/') }}"><img src="{{ asset('img/logo_coclus.png') }}"></a>
    <div class="vertical-form-box-register">
        <h2>Registrarme</h2>
        @if (Auth::user()->profile_type == strtolower("professional"))
            <h4>Soy un Profesional del Área</h4>
            <form class="vertical-form set_profile_form" role="form" method="POST" action="{{ url('/set_profile/professional') }}">
                {{ csrf_field() }}
                <div class="">
                    <h3>¿Cuál es tu especialidad?</h3>
                    <select name="speciallity" class="vertical-form-input-register">
                        <option value=""></option>
                        @foreach($speciallities as $speciallity)
                            <option value="{{ $speciallity->id }}" {{ old('speciallity') == "{$speciallity->id}" ? 'selected' : '' }}>{{ $speciallity->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('speciallity'))
                        <span class="error-block">
                        <strong>{{ $errors->first('speciallity') }}</strong>
                    </span>
                    @endif

                    <h3>¿Empresa o Independiente?</h3>
                    <select class="vertical-form-input-register" name="category" value="{{ old('category') }}">
                        <option></option>
                        <option {{ old('category') == "Empresa" ? 'selected' : '' }}>Empresa</option>
                        <option {{ old('category') == "Independiente" ? 'selected' : '' }}>Independiente</option>
                        <option {{ old('category') == "Otra" ? 'selected' : '' }}>Otro</option>
                    </select>
                    @if ($errors->has('category'))
                        <span class="error-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="selec-intereses">
                    <h3>Ingresa tus intereses</h3>
                    <ul class="list-interest" id="{{ Auth::user()->id  }}">
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Tecnología">Tecnología</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Política">Política</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Negocios">Negocios</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Diseño">Diseño</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Arte">Arte</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Deporte">Deporte</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Humor">Humor</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Salud">Salud</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Ciencia">Ciencia</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Libros">Libros</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Comida">Comida</span></li>
                        <li style="background-image: url('http://lorempixel.com/180/130/');"><span data-value="Computación">Computación</span></li>
                    </ul>
                </div>
                <button type="submit" class="btn-login vertical-form-input try">Pagar</button>
            </form>
        @else
            <h2>Al parecer no habias seleccionado este tipo de perfil.</h2>
            <a href="{{ url('/set_profile/' . Auth::user()->profile_type ) }}">Ir a mi tipo de Perfil</a>
        @endif
    </div>
    <div class="modal">
        <img src="{{ asset('img/logo_coclus_text.png') }}" alt="Coclus" />
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
