<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="{{ asset('/img/favicon-01.png') }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coclus</title>
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
  <div class="landing">
    <div class="container landing_container">
      <header>
        <a href="/">
          <img src="img/logo_coclus.png" data-rjs="2" alt="Coclus">
        </a>
        <nav class="menu scroll">
          <a href="#landing">Inicio</a>
          <a href="#que_es">Qué es Coclus</a>
          <a href="#como_funciona">Cómo funciona</a>
          <a href="#historia">Historia</a>
          <a href="/login">Iniciar sesión</a>
          <a href="/register">Registrarme</a>
        </nav>
      </header>
      <div class="info">
        <div>
          <h1>Únete a la mayor comunidad  online de la discapacidad auditiva</h1>
          <h4>¡Regístrate para recibir más información y prepárate para tu integración a la comunidad!</h4>
          <form action="{{ url('/set_profile') }}" id="form__registro" class="form__registro">
            <input type="email" class="email__registro" id="email__registro" name="email" placeholder="Email">
            <input type="submit" name="btnRegistro" class="btnRegistro" value="Registrarse">
            <span class="form__info"></span>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="que_es" id="que_es">
    <div class="container que_es_container">
      <img src="img/world.png" class="col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-offset-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0" />
      <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12 info__que-es">
        <h2 class="title">¿Qué es?</h2>
        <p>Coclus es la plataforma social para la comunidad de la discapacidad auditiva que te permitirá interactuar con personas que tengan las mismas necesidades e intereses que tú.</p>
      </div>
    </div>
  </div>
  <div class="como_funciona" id="como_funciona">
    <div class="container_fluid como-funciona__container">
      <h2 class="title">¿Cómo funciona?</h2>
      <h5 class="subtitle">Coclus ofrecerá inicialmente tres perfiles:</h5>

      <div class="persona">
        <img src="img/persona_sorda.png" alt="Persona Sorda">
        <p>Soy una persona con discapacidad auditiva</p>
      </div>
      <div class="persona">
        <p>Soy familiar de una persona con discapacidad auditiva</p>
        <img src="img/familia.png" alt="Familiar Persona Sorda" class="familia">
      </div>
      <div class="persona">
        <img src="img/doctor.png" alt="Doctor del Área">
        <p>Soy un profesional del área</p>
      </div>
    </div>
  </div>
  <div class="container caracteristicas">
    <div class="row">
      <div class="col-sm-6 caracteristica">
        <img src="img/share-01.png" alt="Compartir">
        <p>Podrás conectarte con los usuarios de la comunidad para compartir experiencias y datos útiles.</p>
      </div>
      <div class="col-sm-6 caracteristica">
        <img src="img/config-01.png" alt="Servicios">
        <p>Te ofreceremos una variedad de servicios e información que te permitirá mejorar tu calidad de vida y facilitar la inclusión.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 caracteristica">
        <img src="img/cart-01.png" alt="Compra de Productos">
        <p>Encontrarás catálogos de productos y servicios profesionales relacionados con la discapacidad auditiva.</p>
      </div>
      <div class="col-sm-6 caracteristica">
        <img src="img/person-01.png" alt="Programas Educativos">
        <p>Tendrás a tu disposición variados programas educativos y juegos relacionados con la discapacidad auditiva.</p>
      </div>
    </div>
  </div>
  <div class="historia" id="historia">
    <div class="container historia__container">
      <div class="row">
        <div class="col-md-8">
          <h2 class="title">La historia de Coclus</h2>
          <p>Matías Donoso nació con sordera profunda, y es usuario de audífono e implante coclear. Desde su infancia ha desarrollado vínculos con la comunidad de la discapacidad auditiva, compartiendo con los demás su propia experiencia y las restricciones y dificultades que deben enfrentar las personas que viven una realidad similar. Esto lo ha motivado a desarrollar modernas herramientas que faciliten la vida de esta poco conocida comunidad y transformar así la discapacidad auditiva, desde la simple visión de un impedimento a un desafío factible de transitar en el desarrollo personal.</p>
        </div>
        <div class="col-md-4 matias">
          <img src="img/history-matias.png" alt="Matías Donoso &ndash; CEO & Founder">
          <p>Matías donoso &ndash; CEO & Founder</p>
        </div>
      </div>
    </div>
  </div>
  <div class="apoyo">
    <div class="container apoyo__container">
      <h2 class="title">Nos apoyan</h2>
      <ul class="logos">
        <li>
          <img src="img/logo-microsoft.png" alt="Microsoft">
        </li>
        <li>
          <img src="img/logo-corfo.png" alt="CORFO">
        </li>
        <li>
          <img src="img/logo-imagine.png" alt="ImagineLabs">
        </li>
      </ul>
    </div>
  </div>
  <div class="footer">
    <div class="container footer__container">
      <div class="logo__foter">
        <img src="img/logo-coclus-footer.png" alt="Coclus">
      </div>
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <nav class="menu__footer scroll">
            <a href="#landing">Inicio</a>
            <a href="#que_es">Qué es Coclus</a>
            <a href="#como_funciona">Cómo funciona</a>
            <a href="#historia">Historia</a>
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
  <script src="{{ asset('js/libraries/jquery.min.js') }}"></script>
  <script src="{{ asset('js/plugins/retina.min.js') }}"></script>
  <script src="http://cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
