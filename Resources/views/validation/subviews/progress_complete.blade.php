<div class="brand-card">
    <div class="brand-card-header bg-primary">
        <h1 class="text-white text-capitalize">{{ $event_validation->validation->alias }}</h1>
    </div>
    <div class="brand-card-body">
        <div>
            <div class="text-value">{{ $validated }}</div>
            <div class="text-uppercase text-muted small">Validados</div>
        </div>
        <div>
            <div class="text-value">{{ $modified }}</div>
            <div class="text-uppercase text-muted small">Modificados</div>
        </div>
        <div>
            <div class="text-value">{{ $duplicates }}</div>
            <div class="text-uppercase text-muted small">Duplicados</div>
        </div>
        <div>
            <div class="text-value">{{ $failures }}</div>
            <div class="text-uppercase text-muted small">Falhas</div>
        </div>
    </div>
    <div class="card-footer">
        @if($porcent != 100)
        <div class="progress-group mb-0">
            <div class="progress-group-header">
                <div class="text-capitalize">{{ $legend }}</div>
                <div class="ml-auto font-weight-bold">{{ $porcent }}%</div>
            </div>
            <div class="progress-group-bars">
                <div class="progress progress-xs bg-secondary">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        @else
        <div class="progress-group mb-0">
            <div class="progress-group-header">
                <div class="text-capitalize">{{ $legend_animated }}</div>
            </div>
            <div class="progress-group-bars">
                <div class="progress progress-xs bg-secondary">
                    <div class="progress-bar progress-bar-striped {{ $progress_bar_animated }}" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
