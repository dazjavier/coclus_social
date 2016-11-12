<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
    <div class="sidebar-user-info">
        <div class="img-container" style="background-image: url({{ asset(Auth::user()->getAvatarUrl()) }})"></div>
        <h4>{{ Auth::user()->getFullName() }}</h4>
        <h5>{{ Auth::user()->getUsername() }}</h5>
    </div>
    <ul class="menu-sidebar-profile">
        <li>
            <a href="{{ url('/my_profile') }}" class="{{ Request::is('my_profile') ? 'active' : '' }}">
                <i class="fa fa-fw fa-info-circle"></i>
                Información
            </a>
        </li>
        <li>
            <a href="{{ url('/my_statuses') }}" class="{{ Request::is('my_statuses') ? 'active' : '' }}">
                <i class="fa fa-fw fa-comments"></i>
                Estados
            </a>
        </li>
        <li>
            <a href="{{ url('/settings') }}" class="{{ Request::is('settings') ? 'active' : '' }}">
                <i class="fa fa-fw fa-cog"></i>
                Configuración
            </a>
        </li>
    </ul>
</div>
