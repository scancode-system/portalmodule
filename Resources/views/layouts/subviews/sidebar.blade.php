<div class="sidebar">

    {{ Form::Open(['route' => ['events.parameterless.update'], 'method' => 'put']) }}
    {{ Form::hidden('selected', 1) }}
    {{ Form::select('id_event', $events, $id_event, ['class' => 'form-control form-control-sm mx-3 w-auto my-3', 'id' => 'select_event_change']) }}
    {{ Form::Close() }}

    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Pré feira</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.settings.index', 'home') }}">
                    <i class="nav-icon icon-settings"></i> Configurações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.imports') }}">
                    <i class="nav-icon fa fa-upload"></i> Importações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.images.index') }}">
                    <i class="nav-icon icon-picture"></i> Imagens
                </a>
            </li>
            <li class="nav-title">Pós feira</li>
            <li class="nav-item">
                <a class="nav-link nav-link-info" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon fa fa-qrcode"></i> Painel Online
                </a>
            </li>
            <!--<li class="nav-item">
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
                <a class="nav-link" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon icon-list"></i> Pedidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon icon-docs"></i> Relatorios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon fa fa-handshake-o"></i> Integração
                </a>
            </li>-->
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>