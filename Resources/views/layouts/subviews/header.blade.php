<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('portal.dashboard') }}">
        <img class="navbar-brand-full" src="{{ url('modules/portal/img/brand/logo.svg') }}" width="89" height="25" alt="Scancode Logo">
        <img class="navbar-brand-minimized" src="{{ url('modules/portal/img/brand/sygnet.svg') }}" width="30" height="30" alt="Scancode Logo">
    </a>
    <ul class="nav navbar-nav ml-auto">
        <li>{{ auth('company')->user()->name }}</li>
        @if(Auth::guard('admin')->check())
        <li class="nav-item d-md-down-none">
            <a href="{{ route('admin.companies') }}" class="text-danger"> <!-- Aqui deveria ser um componente basico entre company e admin, ou seja haver um load de modulos, talvez o header pode ser unico -->
                <i class="icon-people icons"></i>
            </a>
        </li>
        @endif
        <li class="nav-item d-md-down-none">
            {{ Form::open(['route' => 'logout']) }}
                @csrf
                {{ Form::button('<i class="icon-logout"></i>', ['type' => 'submit', 'class' => 'nav-link']) }}
            {{ Form::close() }}
        </li>
    </ul>
</header>