@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-uppercase lead">
				videos tutoriais
			</div>
			<div class="card-body text-uppercase">
				<p class="lead text-center">
					assista o video de cada uma das validações, uma demonstração passo a passo de como é fácil e simples importar e validar seus dados.
				</p>
				<div class="row">
					@foreach($company_validations as $company_validation)
					<div class="col">
						<a href="{{ $company_validation->validation->video }}" target="_blank" class="btn my-5 w-100">
							<i class="mb-3 text-primary fa fa-file-video-o fa-4x"></i>
							<div class="">Videos de {{ $company_validation->validation->alias }}</div>
						</a>
					</div>
					@endforeach
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
<li class="breadcrumb-item">Documentações em PDF</li>
@endsection