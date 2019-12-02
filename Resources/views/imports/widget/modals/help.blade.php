<div class="modal fade" id="help-validation-{{ $event_validation->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">Importação - {{ $event_validation->validation->alias }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-auto"  style="height: 400px;">
                @include($event_validation->validation->module_alias.'::doc')
            </div>
            <div class="modal-footer">
                <a href="{{ route('portal.doc.download.sample', $event_validation) }}" class="btn btn-brand btn-success">
                    <i class="fa fa-file-excel-o"></i><span>Layout</span>
                </a>
                <button type="button" class="btn btn-brand btn-primary" id="recommendations_{{ $event_validation->id }}">
                    <i class="fa fa-question"></i><span>Recomendações</span>
                </button>
                <button type="button" class="btn btn-brand btn-danger" id="video_{{ $event_validation->id }}">
                    <i class="fa fa-play-circle"></i><span>Video</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="faq-{{ $event_validation->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body overflow-auto">
                <div class="alert alert-info mb-0" role="alert">
                  Segue algun pontos como reomendaçao antes de importar o arquivo.
                  <ul>
                      <li>Passar todos os campos da planilha em formato <strong>texto</strong></li>
                      <li>Limpar possiveis linhas em brancas no final do arquivo</li>
                      <li>Usar nosso layout padrao para importar</li>
                  </ul>
                  <p>Para mais duvidas ou dicas segue o LINK</p>
                  <a href="{{ route('company.faq') }}" class="btn btn-info d-block">FAQ - Perguntas Frequentes</a>
              </div>
          </div>
      </div>
  </div>
</div>




<script>
    var open_help_{{ $event_validation->id }} = false;
    var open_video_{{ $event_validation->id }} = false;

    $('#recommendations_{{ $event_validation->id }}').click(function(){
        $('#help-validation-{{ $event_validation->id }}').modal('hide');
        open_help_{{ $event_validation->id }} = true;
    });

    $('#video_{{ $event_validation->id }}').click(function(){
        $('#help-validation-{{ $event_validation->id }}').modal('hide');
        open_video_{{ $event_validation->id }} = true;
    });

    $('#help-validation-{{ $event_validation->id }}').on('hidden.bs.modal', function (e) {
        if(open_help_{{ $event_validation->id }}){
            $('#faq-{{ $event_validation->id }}').modal('show');
            open_help_{{ $event_validation->id }} = false;
        }

        if(open_video_{{ $event_validation->id }}){
            $('#video-{{ $event_validation->id }}').modal('show');
            open_video_{{ $event_validation->id }} = false;
        }
    });
   
     $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })
</script>