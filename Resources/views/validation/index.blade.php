@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-uppercase">
				VALIDAÇÃO DE {{ $company_validation->validation->alias }}
			</div>
			<div class="card-body">
				<p class="lead text-center">
					Estamos validando sua tabela de {{ $company_validation->validation->alias }}, aguarde isso pode demorar alguns minutos.
				</p>
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
	<a href="{{ route('portal.import', $company_validation) }}">Importar {{ $company_validation->validation->alias }}</a>
</li>
<li class="breadcrumb-item text-capitalize">Validação de {{ $company_validation->validation->alias }}</li>
@endsection