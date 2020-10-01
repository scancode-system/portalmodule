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
                <a class="nav-link" href="{{ route('portal.pos.pdf') }}">
                    <i class="nav-icon fa fa-file-pdf-o"></i> Pedidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.pos.xlsx') }}">
                    <i class="nav-icon fa fa-file-excel-o"></i> Relatórios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portal.pos.txt') }}">
                    <i class="nav-icon fa fa-file-text-o"></i> Importação
                </a>
            </li>
            <span class="small ml-3">Ultima Atualização:</span>
            <span class="small ml-3">{{ $event->sync? $event->sync->format('Y/m/d H:i'):''  }}</span>
            
            <!--<li class="nav-item">
                <a class="nav-link nav-link-info" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon fa fa-qrcode"></i> Painel Online
                </a>
            </li>-->


        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>