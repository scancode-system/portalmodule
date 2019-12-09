@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-uppercase">
				VALIDAÇÃO DE {{ $event_validation->validation->alias }}
			</div>
			<div class="card-body">
				@include('portal::validation.validation')
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
<li class="breadcrumb-item text-capitalize">
	<a href="{{ route('portal.import', $event_validation) }}">Importar {{ $event_validation->validation->alias }}</a>
</li>
<li class="breadcrumb-item text-capitalize">Validação de {{ $event_validation->validation->alias }}</li>
@endsection