
<nav class="navbar navbar-default top-bar affix" data-spy="affix" data-offset-top="250" >
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">FA<span>R</span>EM</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Inicio</a></li>
        @if (Auth::guest())

        <li><a href="/register">Registrarse</a></li>
        <li><a href="/login">Login</a></li>

        @else
        @if (Auth::user()->tipo == "Administrador") 
        <li><a href="/home">Administracion</a></li>
        <li>  <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          Salir
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      @else
      <li><a href="/reservaciones2">Reservar</a></li>
      <li>  <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        Salir
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @endif
      <!-- <li><a href="#blog">Blog</a></li> -->
      <!-- <li><a href="#testimonial">Testimonials</a></li> -->
      <!-- <li><a href="#contact">Contacto</a></li> -->
      @endif
    </ul>
  </div><!--/.nav-collapse -->
</div>
</nav>
