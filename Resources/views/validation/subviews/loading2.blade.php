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