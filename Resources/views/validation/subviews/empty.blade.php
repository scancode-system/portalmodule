
<div class="brand-card">
    <div class="brand-card-header bg-secondary">
        <h1 class="text-white">Produtos</h1>
    </div>
    <div class="brand-card-body">
        <div>
            <div class="text-value">0</div>
            <div class="text-uppercase text-muted small">Validados</div>
        </div>
        <div>
            <div class="text-value">0</div>
            <div class="text-uppercase text-muted small">Modificados</div>
        </div>
        <div>
            <div class="text-value">0</div>
            <div class="text-uppercase text-muted small">Duplicados</div>
        </div>
        <div>
            <div class="text-value">0</div>
            <div class="text-uppercase text-muted small">Falhas</div>
        </div>
    </div>
    <div class="card-footer">
        <div id="dropzone-import" class="dropzone">
            <div class="dz-message m-0">
                <i class="fa fa-upload fa-lg fa-2x text-secondary"></i>
            </div>
        </div>
    </div>
</div>
<!--
@if($required)
<div class="progress-group">
    <div class="progress-group-header">
        <div class="text-capitalize">{{ $legend }}</div>
        <div class="ml-auto font-weight-bold">{{ $porcent }}%</div>
    </div>
    <div class="progress-group-bars">
        <div class="progress progress-xs">
            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
@if($porcent == 100)
<div class="progress-group">
    <div class="progress-group-header">
        <div class="text-capitalize">{{ $legend_animated }}</div>
    </div>
    <div class="progress-group-bars">
        <div class="progress progress-xs">
            <div class="progress-bar progress-bar-striped {{ $progress_bar_animated }}" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
@endif
@if($export)
<div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('portal.main', 1) }}" class="btn btn-secondary">Voltar para Importações</a>
    @if($is_success)
    <a href="{{ route('portal.validation.download', $event_validation) }}" class="btn btn-primary">Validado (Download)</a>
    @else
    <a href="{{ route('portal.validation.download', $event_validation) }}" class="btn btn-danger">Não Validado (Download)</a>
    @endif
</div>
@endif
@else
<div class="row my-5">
    <div class="col">
        <div class="alert alert-danger" role="alert">
            Colunas não presentes na planilha.
        </div>
        <ul class="list-group mb-3">
            @foreach($missing_headings as $missing_heading)
            <li class="list-group-item">{{ $missing_heading }}</li>
            @endforeach
        </ul>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('portal.main', 1) }}" class="btn btn-secondary">Voltar para Importações</a>
        </div>
    </div>
</div>
@endif
-->