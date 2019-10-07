<div class="brand-card-body">
    <div>
        <a href="#" class="text-decoration-none text-secondary" data-toggle="modal" data-target="#no-file-validation-{{ $event_validation->id }}">
            <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
            Original
        </a>
    </div>
    <div>
        <a href="#" class="text-decoration-none text-secondary" data-toggle="modal" data-target="#no-file-validation-{{ $event_validation->id }}">
            <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
            Modificado
        </a>
    </div>
    <div>
        <a href="#" class="text-secondary text-decoration-none" data-toggle="modal" data-target="#no-file-validation-{{ $event_validation->id }}">
            <i class="fa fa-file-text-o fa-lg  fa-2x mb-2"></i><br>
            Relatório
        </a>
    </div>
    <div>
        <a href="#" class="text-decoration-none text-secondary" data-toggle="modal" data-target="#help-validation-{{ $event_validation->id }}">
            <i class="fa fa-question-circle fa-lg  fa-2x mb-2"></i><br>
            Ajuda
        </a>
    </div>
</div>
<p class="mb-2 text-muted text-center">
    <small>
        Nenhuma Importação ainda realizada
    </small>
</p>
@include('portal::imports.widget.modals.empty')