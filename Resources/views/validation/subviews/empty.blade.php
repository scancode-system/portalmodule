<div class="brand-card">
    <div class="brand-card-header bg-secondary">
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
        <div id="dropzone-import-{{ $event_validation->id }}" class="dropzone" onload="alert('fd');">
            <div class="dz-message m-0">
             {{ Form::button('<i class="fa fa-upload fa-lg fa-2x text-white"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-secondary']) }}
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



{{ Html::style('modules/portal/dropzone/dropzone.css') }}
<style type="text/css">
  .card-footer .dropzone{border: none; background: none; padding: 0px; min-height: 0px;}
  .card-footer .dz-message{margin: 0px;}  

</style>
{{ Html::script('modules/portal/dropzone/dropzone.js') }}
<script>

    var layout = document.getElementById('layout').innerHTML;

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
                if(progress == 100){
                    $("#progressbar-file-{{ $event_validation->id }}").addClass("progress-bar-striped progress-bar-animated");
                }
            }
        },
        success: function(file, response, xhr){
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

            $(".errors_{{ $event_validation->id }}").load('{{ route('portal.validation.errors', $event_validation->id) }}', response.errors, function(){
                dropzone_import_{{ $event_validation->id }}.removeAllFiles();
            });
        }
    });
</script>