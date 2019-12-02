@extends('portal::layouts.app')

@section('content')
<div class="card">
	<h5 class="card-header">Scancode Portal Online!</h5>
	<div class="card-body">
		<p>Seja bem vindo ao portal. Aqui, você será capaz de validar seus arquivos e configurar o sistema previamente.</p>
		<p>Abaixo segue os vídeos para já se familiarizar com o portal.</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<h5 class="card-header">Pré Feira</h5>
			<div class="card-body text-center">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<h5 class="card-header">Pós Feira</h5>
			<div class="card-body text-center">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection