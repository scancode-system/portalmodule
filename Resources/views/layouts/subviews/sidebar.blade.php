<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <!--<li class="nav-item">
                <a class="nav-link" href="{{ route('portal.companies.edit', [auth()->user(), 0]) }}">
                    <i class="nav-icon fa fa-id-card-o"></i> Empresa
                </a>
            </li>
            0<li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">
                    <i class="nav-icon fa fa-ticket"></i> Eventos
                </a>
            </li>-->        
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.main', 1) }}">
                    <i class="nav-icon fa fa-download"></i> Importação
                </a>
            </li>
                        <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon icon-graph"></i> Vendas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.videos') }}">
                    <i class="nav-icon icon-list"></i> Pedidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.videos') }}">
                    <i class="nav-icon icon-docs"></i> Relatorios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.integrations') }}">
                    <i class="nav-icon fa fa-handshake-o"></i> Integração
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>