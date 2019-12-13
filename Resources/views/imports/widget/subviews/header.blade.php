<div class="brand-card-header bg-{{ ($event_validation->original_file)?'primary':'secondary' }} px-4">
    <h1 class="text-white text-capitalize flex-fill">{{ $event_validation->validation->alias }}</h1>
    <a href="{{ route('imports.widget.download.demo', $event_validation) }}" class="btn btn-lg btn-link text-decoration-none"><i class="fa fa-download fa-lg"></i><span class="text-white ml-2"> Padrão</span></a>
</div>