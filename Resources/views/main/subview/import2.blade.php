<div class="row">
    <div class="col-sm-6 col-lg-6" id="container_produtos">
        @include('portal::validation.subviews.validation_event', ['event_validation' => 7])
        <!--<div class="brand-card">
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
        </div>-->
    </div>
    <div class="col-sm-6 col-lg-6">
        <div class="brand-card">
            <div class="brand-card-header bg-primary">
                <h1 class="text-white">Clientes</h1>
            </div>
            <div class="brand-card-body">
                <div>
                    <div class="text-value">1000</div>
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
            <div class="brand-card-body">
                <div class="text-primary">
                    <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                    Original
                </div>
                <div class="text-info">
                    <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                    Debug
                </div>
                <div class="text-secondary">
                    <i class="fa fa-file-text-o fa-lg  fa-2x mb-2"></i><br>
                    Relatório
                </div>
                <div class="text-success">
                    <i class="fa fa-file-excel-o fa-lg  fa-2x mb-2"></i><br>
                    Final
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-link w-100 m-0 p-0"><i class="fa fa-upload fa-lg "></i></button>
            </div>
        </div>
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
                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
            </div>
        </div>
    </div>
</div>


@push('styles')
{{ Html::style('modules/portal/dropzone/dropzone.css') }}
@endpush

@push('scripts')
{{ Html::script('modules/portal/dropzone/dropzone.js') }}

<script>

    var layout = $('#layout').html();

    var dropzone_import = new Dropzone('#dropzone-import', {
        url: '{{ route("portal.validation", 7) }}',
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
            }
        },
        success: function(){
            var interval = setInterval(function(){
                $("#container_produtos").load('{{ route('portal.validation.info2', 7) }}');
            }, 1000);

            $.post('{{ route('portal.validation.start2', 7) }}').always(function(data) {
                clearInterval(interval);
                $("#container_produtos").html(data);
            });
        }
    });


</script>
<style>
    .dropzone{border: none; background: none; padding: 0px; min-height: 0px;}
    .dz-message{margin: 0px;}
</style>

@endpush