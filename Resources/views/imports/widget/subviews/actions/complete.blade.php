<div class="brand-card-body">
    <div>
        <a href="{{ route('imports.widget.download.original', $event_validation->id) }}" class="text-decoration-none text-primary">
            <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
            Original
        </a>
    </div>
    <div>
        <a href="{{ route('imports.widget.download.debug', $event_validation->id) }}" class="text-decoration-none text-info">
            <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
            Modificado
        </a>
    </div>
        <div>
        <a href="{{ route('imports.widget.download.clean', $event_validation->id) }}" class="text-decoration-none text-success">
            <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
            Filtrado
        </a>
    </div>
    <div>
        <a href="#" class="text-muted text-decoration-none" data-toggle="modal" data-target="#exampleModal_{{ $event_validation->id }}">
            <i class="fa fa-file-text-o fa-lg  fa-2x mb-2"></i><br>
            Relatório
        </a>
    </div>
    <!--<div>
        <a href="#" class="text-decoration-none text-secondary" data-toggle="modal" data-target="#help-validation-{{ $event_validation->id }}">
            <i class="fa fa-question-circle fa-lg  fa-2x mb-2"></i><br>
            Ajuda
        </a>
    </div>-->
</div>
<p class="mb-2 text-muted text-center">
    <small>
        Última importação em: {{ $event_validation->update->format('Y/m/d H:i:s') }}
    </small>
</p>
@include('portal::imports.widget.modals.report')