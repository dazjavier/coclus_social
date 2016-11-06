<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
    <div class="sidebar-user-info">
        <div class="img-container">
            <img src="{{ asset($user->getAvatarUrl()) }}" alt="{{ $user->getFullName() }}">
        </div>
        <h4>{{ $user->getFullName() }}</h4>
        <h5>{{ $user->getUsername() }}</h5>
    </div>
    <ul class="menu-sidebar-profile">
        <li>
            <a href="{{ url("/users/{$user->username}") }}" class="{{ Request::is("users/{$user->username}") ? 'active' : '' }}">
                <i class="fa fa-fw fa-info-circle"></i>
                Información
            </a>
        </li>
        <li>
            <a href="{{ url("/users/{$user->username}/statuses") }}" class="{{ Request::is("users/{$user->username}/statuses") ? 'active' : '' }}">
                <i class="fa fa-fw fa-comments"></i>
                Estados
            </a>
        </li>
    </ul>
</div>
