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
    <div class="brand-card-body">
        <div class="text-primary">
            <a href="{{ route('portal.validation.download.original', $event_validation->id) }}" class="text-decoration-none">
                <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                Original
            </a>
        </div>
        <div class="">
            <a href="{{ route('portal.validation.download.debug', $event_validation->id) }}" class="text-info text-decoration-none">
                <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                Debug
            </a>
        </div>
        <div class="">
            <a href="{{ route('portal.validation.download.clean', $event_validation->id) }}" class="text-decoration-none text-success">
                <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                Filtrado
            </a>
        </div>
        <div class="">
            <a href="#" class="text-secondary text-decoration-none" data-toggle="modal" data-target="#exampleModal_{{ $event_validation->id }}">
                <i class="fa fa-file-text-o fa-lg  fa-2x mb-2"></i><br>
                Relatório
            </a>
        </div>
    </div>
    <p class="mb-2 text-muted text-center"><small>Última importação em: {{ $event_validation->update->format('Y/m/d H:i:s') }}</small></p>
    <div class="card-footer">
        <div class="d-flex">
            <div id="dropzone-import-{{ $event_validation->id }}" class="dropzone flex-fill pr-2" onload="alert('fd');">
                <div class="dz-message m-0">
                    {{ Form::button('<i class="fa fa-upload fa-lg fa-2x "></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-primary']) }}
                </div>
            </div>
            <div class="flex-fill text-center pl-2" id="btn-clean_{{ $event_validation->id }}">
                {{ Form::open(['route' => ['portal.validation.clean', $event_validation->id], 'method' => 'put']) }}
                {{ Form::button('<i class="fa fa-trash fa-lg fa-2x"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-danger']) }}
                {{ Form::close() }}
            </div>
        </div>
        <div class="errors_{{ $event_validation->id }}"></div>
    </div>
</div>

<div id="layout" class="d-none">
    <div class="progress-group mb-0">
        <div class="progress-group-header align-items-end">
            <div>Transferindo arquivo (<span data-dz-name></span>)</div>
            <div class="ml-auto font-weight-bold mr-2 progress-text"><!--<span data-dz-size></span>--></div>
            <!--<div class="text-muted small">(<span class="progress-text"></span>)</div>-->
        </div>
        <div class="progress-group-bars">
            <div class="progress progress-xs bg-secondary">
                <div class="progress-bar bg-primary" id="progressbar-file-{{ $event_validation->id }}" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
            </div>
        </div>
    </div>
</div>



<!-- Report -->
<div class="modal fade" id="exampleModal_{{ $event_validation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes da Importação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::textarea('d',  $event_validation->report, ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



{{ Html::style('modules/portal/dropzone/dropzone.css') }}
<style type="text/css">
  .card-footer .dropzone{border: none; background: none; padding: 0px; min-height: 0px;}
  .card-footer .dz-message{margin: 0px;}  

</style>
{{ Html::script('modules/portal/dropzone/dropzone.js') }}
<script>

    var layout = document.getElementById('layout').innerHTML;
    console.log(layout);
    var dropzone_import_{{ $event_validation->id }} = new Dropzone('#dropzone-import-{{ $event_validation->id }}', {
        url: '{{ route("portal.validation2", $event_validation->id) }}',
        params: {
         extension: "xlsx"
     },
     headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
     previewTemplate: layout,
     uploadprogress: function(file, progress, bytesSent) { 
        if (file.previewElement) {
            var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
            progressElement.style.width = progress + "%";
            file.previewElement.querySelector(".progress-text").textContent = progress + "%";
            $('#btn-clean_{{ $event_validation->id }}').hide();
            if(progress == 100){
                $("#progressbar-file-{{ $event_validation->id }}").addClass("progress-bar-striped progress-bar-animated");
            }
        }
    },
    success: function(){
        var interval = setInterval(function(){
            $("#container_{{ $event_validation->id }}").load('{{ route('portal.validation.info2', $event_validation->id) }}');
        }, 1000);

        $.post('{{ route('portal.validation.start2', $event_validation->id) }}').always(function(data) {
            clearInterval(interval);
            $("#container_{{ $event_validation->id }}").html(data);
        });
    },
    error: function(file, response, xhr){
        console.log(response.errors);
        $('#btn-clean_{{ $event_validation->id }}').show();
        $(".errors_{{ $event_validation->id }}").load('{{ route('portal.validation.errors', $event_validation->id) }}', response.errors, function(){
            dropzone_import_{{ $event_validation->id }}.removeAllFiles();
        });
    }
});
</script>