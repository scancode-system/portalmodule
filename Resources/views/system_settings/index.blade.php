@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<h5 class="card-header">Configuracoes</h5>
			<div class="card-body">
				@if(session()->has('success_client_setting'))
				<div class="alert alert-success alert-dismissible fade show">
					{{ session()->get('success_client_setting') }}
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
				{{ Form::Open(['route' => ['portal.system_setting.update', $system_setting->id], 'method' => 'PUT']) }}
				<div class="form-row">
					<div class="form-group col-md-6">
						{{ Form::label('start_id_order', 'Número inicial dos pedidos', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Aqui voce pode selecionar a partir de que numero os pedidos se iniciam']) }}
						{{ Form::number('start_id_order', $system_setting->start_id_order, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-md-6">
						{{ Form::label('number_sheets', 'Número de vias a ser impresso', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Quantas vias serao imprimidas na impressao automatica, quando o pedido e finalizado']) }}
						{{ Form::number('number_sheets', $system_setting->number_sheets, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('note', 'Observação', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Configure a observacao que sera exibida em todas as vias impressas dos pedidos']) }}
					{{ Form::textarea('note', $system_setting->note, ['class' => 'form-control', 'placeholder' => '"Nossos pedidos serão entregues de acordo com disponibilidade de estoque"']) }}
					<small class="form-text text-muted">
						Campo de observação do pedido, é um campo onde você pode colocar
						um texto padrão que vai aparecer na impressão de todos os pedidos.
					</small>
				</div>
				<hr>
				<p class="lead">
					Nosso sistema envia uma cópia do pedido para seus clientes, configure
					o remetente, assunto, e um pequeno texto para o email.
				</p>
				<div class="form-row">
					<div class="form-group col-md-6">
						{{ Form::label('email_from', 'Remetente', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Configure a origem do email do pedido']) }}
						{{ Form::text('email_from', $system_setting->email_from, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-md-6">
						{{ Form::label('email_subject', 'Assunto', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Defina o assunto do email do pedido']) }}
						{{ Form::text('email_subject', $system_setting->email_subject, ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('email_note', 'Mensagem do corpo do email', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Caso queira pode colocar uma mensagem no corpo do email do pedido']) }}
					{{ Form::textarea('email_note', $system_setting->email_note, ['class' => 'form-control']) }}
				</div>
				{{ Form::submit('SALVAR', ['class' => 'btn btn-danger btn-lg']) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">Configuraçoes do Evento</li>
@endsection


@push('scripts')
<script>
     $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      });
</script>
@endpush