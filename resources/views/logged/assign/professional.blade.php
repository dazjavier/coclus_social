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
            <form class="vertical-form" role="form" method="POST" action="{{ url('/set_profile/professional') }}">
                {{ csrf_field() }}
                <div class="">
                    <h5>¿Cuál es tu especialidad?</h5>
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

                    <h5>¿Empresa o Independiente?</h5>
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
                    <h5>Ingresa tus intereses</h5>
                    <div data-tags-input-name="intereses" id="tagBox" class="vertical-form-input-register intereses-textbox"></div>
                </div>
                <button class="btn-login vertical-form-input">Finalizar registro</button>
            </form>
        @else
            <h2>Al parecer no habias seleccionado este tipo de perfil.</h2>
            <a href="{{ url('/set_profile/' . Auth::user()->profile_type ) }}">Ir a mi tipo de Perfil</a>
        @endif
    </div>
    <div class="modal">
        <img src="{{ asset('img/logo_coclus_text.png') }}" alt="" />
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://sniperwolf.github.io/taggingJS/example/tag-basic-style.css">
    <script src="{{ asset('js/plugins/tagging.min.js') }}"></script>
    <script type="text/javascript">
        $("#tagBox").tagging();
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
