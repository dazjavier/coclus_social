<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coclus</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
</head>
<body>
    <nav class="navbar navbar-coclus">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/timeline') }}">
                    <img src="{{ asset('img/logo_coclus_app.png') }}" alt="Coclus" class="img-brand" />
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-inset" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/timeline') }}">Inicio</a></li>
                    @if (Auth::check())
                        <li><a href="{{ route('friends.index') }}">Amigos</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesión</a></li>
                        <li><a href="{{ url('/register') }}">Registrate</a></li>
                    @else
                        <li>
                            <form class="navbar-form navbar-left" action="{{ route('search.results') }}" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control input-text" placeholder="Busca personas" name="q">
                                </div>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-fw fa-search"></i>
                                </button>
                            </form>
                        </li>
                        <li>
                            @if (Auth::user()->friendRequests()->count())
                                <a href="{{ route('friends.index') }}">
                                    <i class="fa fa-fw fa-bell" aria-hidden="true"></i>
                                    {{ Auth::user()->friendRequests()->count() }}
                                </a>
                            @else
                                <a href="{{ route('friends.index') }}">
                                    <i class="fa fa-fw fa-bell" aria-hidden="true"></i>
                                </a>
                            @endif
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->getFullName() }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" class="small">Logueado como <b>{{ Auth::user()->username }}</b></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/my_profile') }}">Perfil</a></li>
                                <li><a href="{{ route('friends.index') }}">Amigos</a></li>
                                <li><a href="{{ url('/settings') }}">Configuración</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="footer">
        <div class="container footer__container">
            <div class="logo__foter">
                <img src="{{ asset('img/logo-coclus-footer.png') }}" alt="Coclus">
            </div>
            <div class="row">
                <div class="col-md-7 col-xs-12">
                    <nav class="menu__footer scroll">
                        <a href="{{ url('/timeline') }}">Inicio</a>
                        @if (Auth::check())
                            <a href="{{ route('friends.index') }}">Amigos</a>
                            <a href="{{ url('/my_profile') }}">Mi perfil</a>
                            <a href="{{ url('/settings') }}">Configuración</a>
                        @endif
                    </nav>
                </div>
                <div class="col-md-5 col-xs-12">
                    <p>Síguenos en las redes sociales &nbsp;&nbsp;&nbsp; <a href="https://www.facebook.com/coclus/"><img src="img/fb.png" alt=""></a>&nbsp;&nbsp;<a href="#"><img src="img/tw.png" alt=""></a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <p>Coclus &copy; &ndash; Todos los derechos reservados.</p>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
