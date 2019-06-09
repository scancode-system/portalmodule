@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-uppercase">
				IMPORTAR {{ $client_validation->validation->alias }}
			</div>
			<div class="card-body">
				<p class="lead text-center">
					Vamos importar e validar seus dados de {{ $client_validation->validation->alias }}!!! Baixe nossa planilha de exemplo no link abaixo, preencha com seus dados
					e importe. Se atente aos campos obrigatórios.
				</p>
				<div class="row mb-5">
					<div class="col text-center">
						<div>
							<a href="{{ route('portal.doc.download.sample', $client_validation) }}" class="block btn my-4">
								<div class="font-weight-bold h3 mb-3 text-capitalize">Download de {{ $client_validation->validation->alias }}</div>
								<i class="fa fa-file-excel-o fa-5x text-success"></i>
							</a>
						</div>
						<small class="text-muted text-center">Faça o download da planilha de exemplo e preencha com seus dados em seguida faça o upload.</small>
					</div>
					<div class="col text-center">
						<div>
							<a href="{{ $client_validation->validation->video }}" class="btn tedxt-white my-4 w-100" target="_blank">
								<div class="font-weight-bold h3 mb-3">Vídeo Explicativo</div>
								<i class="fa fa-file-movie-o fa-5x text-danger"></i>
							</a>
						</div>
						<small class="text-muted text-center">Clique no link acima para vizualizar um tutorial da importação.</small>
					</div>
				</div>
				<div class="row">
					<div class="col">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul class="mb-0">
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<div class="custom-file">
							{{ Form::open(['route' => ['portal.validation', $client_validation], 'enctype' => 'multipart/form-data']) }}
							{{ Form::hidden('extension', 'xlsx') }}
							{{ Form::file('file', ['class' => 'custom-file-input', 'onchange' => 'this.form.submit();']) }}	
							{{ Form::label('file', 'Upload do arquivo de '.$client_validation->validation->alias, ['class' => 'custom-file-label']) }}	
							{{ Form::close() }}					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ route('portal.main', 1) }}">Painel Central - Importar e Validar</a>
</li>
<li class="breadcrumb-item text-capitalize">Importar {{ $client_validation->validation->alias }}</li>
@endsection