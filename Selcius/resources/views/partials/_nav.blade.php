<nav>
  <div class="nav-wrapper">
    <a href="/" class="brand-logo center" style="color: #212121;"><img src="{{asset('Logo.png')}}"> Selcius</a>
    @if(Auth::guest())
    <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li class="{{ Request::is('courses') ? "active" : "" }}"><a href="/courses"><i class="fa fa-book"></i>           Cusos</a></li>
        <li class="{{ Request::is('articles') ? "active" : "" }}"><a href="/articles"><i class="fa fa-newspaper-o"></i>   Artículos</a></li>
        <li class="{{ Request::is('foros') ? "active" : "" }}"><a href="/foros"><i class="fa fa-group"></i>   Foros</a></li>
        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact"><i class="fa  fa-envelope"></i>     Contacto</a></li>
    </ul>
    @endif
    <ul class="right hide-on-med-and-down">
      @if(Auth::guest())

        <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
        <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Register</a></li>

      @else
      <a class="dropdown-button" data-activates="dropdown-2">
      <li class="dropdown user user-image">
      @if(Auth::user()->level == 2)
      <a href="" class="dropdown-button" data-activates="dropdown-1">
      @endif

      <p><img src="{{asset('avatars/'.Auth::user()->image)}}" class="user-image" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">
      <span class="hidden-xs">{{Auth::user()->name}}</span></p></a></li>
        <ul id="dropdown-2" class="dropdown-content">
          <li class="{{ Request::is('courses') ? "active" : "" }}"><a href="/courses"><i class="fa fa-book"></i>           Cusos</a></li>
          <li class="{{ Request::is('articles') ? "active" : "" }}"><a href="/articles"><i class="fa fa-newspaper-o"></i>   Artículos</a></li>
          <li class="{{ Request::is('foros') ? "active" : "" }}"><a href="/foros"><i class="fa fa-group"></i>   Foros</a></li>
          <li class="{{ Request::is('categories') ? "active" : "" }}"><a href="/categories"><i class="fa fa-puzzle-piece"></i>   Categorias</a></li>
          <li class="{{ Request::is('tags') ? "active" : "" }}"><a href="/tags"><i class="fa fa-tags"></i>   Tags</a></li>
          <li class="{{ Request::is('sections') ? "active" : "" }}"><a href="/sections"><i class="fa fa-folder"></i>   Secciones</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Perfil</a></li>
          <li>
            <a href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        </ul>
      <ul id="dropdown-1" class="dropdown-content">

        <li class="{{ Request::is('articulos.index')}}"><a href="/articulos"><i class="fa fa-newspaper-o"></i> Articulos</a></li>
        <li class="{{ Request::is('cursos.index')}}"><a href="/cursos"><i class="fa fa-book"></i> Cursos</a></li>
        <li class="{{ Request::is('foros') ? "active" : "" }}"><a href="/foros"><i class="fa fa-group"></i>   Foros</a></li>
        <li class="{{ Request::is('sections.index')}}"><a href="/sections"><i class="fa fa-folder"></i> Secciones</a></li>
        <li class="{{ Request::is('categories.index')}}"><a href="/categories"><i class="fa fa-puzzle-piece"></i> Categorias</a></li>
        <li class="{{ Request::is('tags.index')}}"><a href="/tags"><i class="fa fa-tags"></i> Tags</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Perfil</a></li>
        <li>
            <a href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      </ul>
      @endif
    </ul>
  </div>
</nav>
<br>
