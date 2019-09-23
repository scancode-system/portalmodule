@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<nav>
					<div class="nav nav-tabs" role="tablist">
						<a class="nav-item nav-link {{ ($tab==0)?'active':'' }}" href="{{ route('portal.main', 0) }}">Importar</a>
						<a class="nav-item nav-link {{ ($tab==1)?'active':'' }}" href="{{ route('portal.main', 1) }}">Importar e Validar (Dados)</a>
						<a class="nav-item nav-link {{ ($tab==2)?'active':'' }}" href="{{ route('portal.main', 2) }}">Configurar Sistema</a>
						<!--<a class="nav-item nav-link {{ ($tab==3)?'active':'' }}" href="{{ route('portal.main', 3) }}">Prévia Online</a>-->
						<a class="nav-item nav-link {{ ($tab==4)?'active':'' }}" href="{{ route('portal.main', 4) }}">Importar Imagens</a>
					</div>
				</nav>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane {{ ($tab==0)?'show active':'' }}">
						@include('portal::main.subview.import2')
					</div>
					<div class="tab-pane {{ ($tab==1)?'show active':'' }}">
						@include('portal::main.subview.import')
					</div>
					<div class="tab-pane {{ ($tab==2)?'show active':'' }}">
						@include('portal::main.subview.setting')
					</div>
					<div class="tab-pane {{ ($tab==4)?'show active':'' }}">
						@include('portal::main.subview.images')
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
<li class="breadcrumb-item">Painel Central</li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">Painel Central</li>
@endsection