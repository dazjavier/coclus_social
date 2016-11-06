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
        @if (Auth::user()->profile_type == strtolower("familiar"))
            <h4>Soy Familiar de una Persona con Discapacidad Auditiva</h4>
            <form class="vertical-form set_profile_form" role="form" method="POST" action="{{ url('/set_profile/familiar') }}">
                {{ csrf_field() }}
                <div class="">
                    <h3>¿Cuál es tu relación con él?</h3>
                    <select class="vertical-form-input-register" name="relation" value="{{ old('relation') }}">
                        <option></option>
                        <option {{ old('relation') == "Madre o Padre" ? 'selected' : '' }}>Madre o Padre</option>
                        <option {{ old('relation') == "Hermana o Hermano" ? 'selected' : '' }}>Hermana o Hermano</option>
                        <option {{ old('relation') == "Tía o Tío" ? 'selected' : '' }}>Tía o Tío</option>
                        <option {{ old('relation') == "Abuela o Abuela" ? 'selected' : '' }}>Abuela o Abuela</option>
                        <option {{ old('relation') == "Otro" ? 'selected' : '' }}>Otro</option>
                    </select>
                    @if ($errors->has('relation'))
                        <span class="error-block">
                            <strong>{{ $errors->first('relation') }}</strong>
                        </span>
                    @endif

                    <h3>¿En que etapas estás?</h3>
                    <select class="vertical-form-input-register" name="step" value="{{ old('step') }}">
                        <option></option>
                        <option {{ old('step') == "Me acabo de enterar" ? 'selected' : '' }}>Me acabo de enterar</option>
                        <option {{ old('step') == "Estoy viviendo la etapa" ? 'selected' : '' }}>Estoy viviendo la etapa</option>
                        <option {{ old('step') == "Ya pasé por la etapa" ? 'selected' : '' }}>Ya pasé por la etapa</option>
                        <option {{ old('step') == "Otra" ? 'selected' : '' }}>Otra</option>
                    </select>
                    @if ($errors->has('step'))
                        <span class="error-block">
                            <strong>{{ $errors->first('step') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="selec-com">
                    <h3>Selecciona sus formas de comunicación</h3>
                    <ul class="communication_types">
                        <li>
                            <label for="implante_coclear">
                                <img src="{{ asset('img/implante_coclear.png') }}" alt="" />
                            </label>
                            <p>
                                <input type="checkbox" name="comunicacion[]" id="implante_coclear" value="Implante Coclear">
                                Implante Coclear
                            </p>
                        </li>
                        <li>
                            <label for="audifono">
                                <img src="{{ asset('img/audifono.png') }}" alt="" />
                            </label>
                            <p>
                                <input type="checkbox" name="comunicacion[]" id="audifono" value="Audífono">
                                Audífono
                            </p>
                        </li>
                        <li>
                            <label for="lengua_de_senias">
                                <img src="{{ asset('img/lengua_de_senias.png') }}" alt="" />
                                <p>
                                    <input type="checkbox" name="comunicacion[]" id="lengua_de_senias" value="Lengua de Señas">
                                    Lengua de Señas
                                </p>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="selec-intereses">
                    <h5>Ingresa tus intereses</h5>
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
                <button class="btn-login vertical-form-input try">Finalizar registro</button>
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
