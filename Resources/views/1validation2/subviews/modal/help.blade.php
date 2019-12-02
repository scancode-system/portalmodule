<div class="modal fade" id="help-validation-{{ $event_validation->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">Importação - {{ $event_validation->validation->alias }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('validationpayment::doc')
            </div>
            <div class="modal-footer">
                <a href="{{ route('portal.doc.download.sample', $event_validation) }}" class="btn btn-brand btn-success">
                    <i class="fa fa-file-excel-o"></i><span>Layout</span>
                </a>
                <button type="button" class="btn btn-brand btn-primary">
                    <i class="fa fa-question"></i><span>Recomendações</span>
                </button>
                <button type="button" class="btn btn-brand btn-danger">
                    <i class="fa fa-play-circle"></i><span>Video</span>
                </button>
            </div>
        </div>
    </div>
</div>