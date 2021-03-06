@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<h5 class="card-header">Upload de Imagens</h5>
			<div class="card-body">
				@if(session()->has('message_images'))
				<div class="alert alert-success alert-dismissible fade show">
					{{ session()->get('message_images') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				<h2>Logo</h2>
				{{ Form::open(['route' => 'portal.images.destroy.logo', 'method' => 'delete']) }}
				{{ Form::submit('Excluir Logo', ['class' => 'btn btn-danger mb-3']) }}
				{{ Form::close() }}
				<div id="dropzone-logo" class="dropzone text-muted"></div>
				<hr>
				<h2>Produtos</h2>
				{{ Form::open(['route' => 'portal.images.destroy', 'method' => 'delete']) }}
				{{ Form::submit('Excluir Imagens', ['class' => 'btn btn-danger mb-3']) }}
				{{ Form::close() }}
				<div id="dropzone-produtos" class="dropzone text-muted"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">Imagens</li>
@endsection

@push('styles')
{{ Html::style('modules/portal/dropzone/dropzone.css') }}
@endpush

@push('scripts')
{{ Html::script('modules/portal/dropzone/dropzone.js') }}


<script>
	Dropzone.autoDiscover = false;


	var dropzone_produtos = new Dropzone('#dropzone-produtos', {
		url: '{{ route("portal.images.produtos") }}',
		headers: {'X-CSRF-Token': "{{ csrf_token() }}" },
		dictDefaultMessage: '<h4>ARRASTE AS IMAGENS DOS PRODUTOS PARA O BOX</h4><h4>OU CLOQUE AQUI</h4><p>AS IMAGENS DEVE ESTAR NOMEADAS DE ACORDO COM A REFERÊNCIA DOS PRODUTOS E DEVE TER NO MÁXIMO 300x300 PIXELS EM ".jpg"</p>'
	});

	
	@foreach($produtos as $key => $produto)
	let mock_produto_{{ $key }} = { name: "Arquivo Salvo", dataURL: "{{ route('portal.images.show', $produto) }}" };
	dropzone_produtos.files.push(mock_produto_{{ $key }});
	dropzone_produtos.emit("addedfile", mock_produto_{{ $key }});
	dropzone_produtos.createThumbnailFromUrl(mock_produto_{{ $key }},
		dropzone_produtos.options.thumbnailWidth, 
		dropzone_produtos.options.thumbnailHeight,
		dropzone_produtos.options.thumbnailMethod, true, function (thumbnail) 
		{
			dropzone_produtos.emit('thumbnail', mock_produto_{{ $key }}, thumbnail);
		});
	dropzone_produtos.emit('complete', mock_produto_{{ $key }});
	@endforeach




	var dropzoneInst = new Dropzone('#dropzone-logo', {
		url: '{{ route("portal.images.logo") }}',
		headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
		dictDefaultMessage: '<h4>ARRASTE A LOGO PARA O BOX</h4><h4>OU CLIQUE AQUI</h4><p>A EXTENSÃO DA LOGO PRECISA SER ".png"</p>'
	});

	@if($logo)

	let mockFile = { name: "Arquivo Salvo", dataURL: "{{ route('portal.images.show.logo') }}" };
	dropzoneInst.files.push(mockFile);
	dropzoneInst.emit("addedfile", mockFile);
	dropzoneInst.createThumbnailFromUrl(mockFile,
		dropzoneInst.options.thumbnailWidth, 
		dropzoneInst.options.thumbnailHeight,
		dropzoneInst.options.thumbnailMethod, true, function (thumbnail) 
		{
			dropzoneInst.emit('thumbnail', mockFile, thumbnail);
		});
	dropzoneInst.emit('complete', mockFile);

	@endif

</script>

@endpush

@section('events')
@include('portal::layouts.subviews.events')
@endsection