@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<h5 class="card-header">Eventos</h5>
			<div class="card-body">
				@if(session()->has('success_events'))
				<div class="alert alert-success alert-dismissible fade show">
					{{ session()->get('success_events') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				@if(session()->has('info'))
				<div class="alert alert-info alert-dismissible fade show">
					{{ session()->get('info') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="mb-0">
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div> 
				@endif
				{{ Form::open(['route' => 'events.store']) }}
				{{ Form::hidden('company_id', auth()->user()->id) }}
				<div class="input-group mb-3">
					{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Evento']) }}
					<div class="input-group-append">
						{{  Form::submit('Salvar', ['class' => 'btn btn-outline-secondary']) }}						
					</div>
				</div>
				{{ Form::Close() }}

				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">Evento</th>
							<th scope="col" class="text-center">Selecionado</th>
							<th scope="col">Token</th>
							<th scope="col" class="text-right">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($events as $event)
						<tr>
							<td scope="row" class="font-weight-bold">{{ $event->name }}</td>
							<td class="text-center">
								@if($event->selected)
								<i class="fa fa-check"></i>
								@else
								{{ Form::Open(['route' => ['events.update', $event], 'method' => 'put']) }}
								{{ Form::hidden('selected', 1) }}
								{{ Form::submit('Selecionar', ['class' => 'btn btn-primary']) }}
								{{ Form::Close() }}
								@endif
							</td>
							<td scope="row">{{ $event->token }}</td>
							<td class="text-right">
								{{ Form::Open(['route' => ['events.destroy', $event], 'method' => 'delete']) }}
								{{  Form::submit('Excluir', ['class' => 'btn btn-danger']) }}	
								{{ Form::Close() }}																			
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item text-capitalize">Eventos</li>
@endsection