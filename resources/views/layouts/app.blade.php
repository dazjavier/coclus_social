<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon-01.png') }}" />

    <title>Coclus</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" media="screen" title="no title">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
    <nav class="navbar navbar-coclus navbar-fixed-top">
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
                    <img src="{{ asset('img/logo_coclus_text.png') }}" alt="Coclus" class="img-brand" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/timeline') }}">Inicio</a></li>
                    @if (! Auth::guest())
                        <li><a href="{{ route('friends.index') }}">Amigos</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesión</a></li>
                        <li><a href="{{ url('/register') }}">Regístrate</a></li>
                    @else
                        <li>
                            <form class="navbar-form navbar-left" action="{{ route('search.results') }}" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Busca personas" name="q">
                                </div>
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </form>
                        </li>
                        <li>
                            @if (Auth::user()->friendRequests()->count())
                                <a href="{{ route('friends.index') }}">
                                    <i class="fa fa-btn fa-bell" aria-hidden="true"></i>
                                    {{ Auth::user()->friendRequests()->count() }}
                                </a>
                            @else
                                <a href="{{ route('friends.index') }}">
                                    <i class="fa fa-btn fa-bell" aria-hidden="true"></i>
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

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
