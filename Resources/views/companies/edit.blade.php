@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<nav>
					<div class="nav nav-tabs" role="tablist">
						<a class="nav-item nav-link {{ ($tab==0)?'active':'' }}" href="{{ route('portal.companies.edit', [auth()->user(), 0]) }}" >Informações da Empresa</a>
						<a class="nav-item nav-link {{ ($tab==1)?'active':'' }}" href="{{ route('portal.companies.edit', [auth()->user(), 1]) }}">Endereço</a>
						<a class="nav-item nav-link {{ ($tab==2)?'active':'' }}" href="{{ route('portal.companies.edit', [auth()->user(), 2]) }}">Dados de Login</a>
					</div>
				</nav>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane {{ ($tab==0)?'show active':'' }}" >
						@include('portal::companies.edit.tab.info')
					</div>
					<div class="tab-pane {{ ($tab==1)?'show active':'' }}">
						@include('portal::companies.edit.tab.address')
					</div>
					<div class="tab-pane {{ ($tab==2)?'show active':'' }}">
						@include('portal::companies.edit.tab.login')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<h5 class="card-header">Dados da Empresa</h5>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h5 class="card-title">Dados de Acesso</h5>
						{{ Form::Open(['portal.company.update', auth()->user()]) }}
						{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
						{{ Form::close() }}
					</div>
					<div class="col-md-6">
						<h5 class="card-title">Endereço</h5>
						{{ Form::Open(['portal.company.update', auth()->user()]) }}
						{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
						{{ Form::close() }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h5 class="card-title">Informações Adicionais</h5>
						{{ Form::Open(['portal.company.update', auth()->user()]) }}
						{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item text-capitalize">Empresa</li>
@endsection