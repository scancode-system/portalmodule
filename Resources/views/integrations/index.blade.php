@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-uppercase">
				Integração de Sistemas
			</div>
			<div class="card-body text-uppercase">
				<p class="lead">
					Abaixo segue o modelo de exportação dos dados do sistema da Scancode, assim seu sistema podera importa-lo.
				</p>
				<div class="row">
					<div class="col">
						<a href="{{ route('portal.dashboard') }}" class="btn my-5 w-100">
							<i class="mb-3 text-danger fa fa-file-pdf-o fa-4x"></i>
							<div class="">Exportação de Pedidos</div>
						</a>
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
<li class="breadcrumb-item">Documentações em PDF</li>
@endsection