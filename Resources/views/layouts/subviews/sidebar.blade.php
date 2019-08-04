<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.companies.edit', [auth()->user(), 0]) }}">
                    <i class="nav-icon fa fa-id-card-o"></i> Empresa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">
                    <i class="nav-icon fa fa-ticket"></i> Eventos
                </a>
            </li>        
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.main', 1) }}">
                    <i class="nav-icon fa fa-download"></i> Importação
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.integrations') }}">
                    <i class="nav-icon fa fa-handshake-o"></i> Integre ao seu ERP
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.videos') }}">
                    <i class="nav-icon fa fa-play-circle"></i> Videos tutorial
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.documentations') }}">
                    <i class="nav-icon fa fa-file-pdf-o"></i> Documentação
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>