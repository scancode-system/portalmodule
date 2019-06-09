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
<h3>CONFIGURAÇÃO</h3>
<hr>
{{ Form::model($client_setting, ['route' => ['portal.client_setting.update', $client_setting], 'method' => 'PUT']) }}
<div class="form-group">
	{{ Form::label('event', 'Nome do Evento') }}
	{{ Form::text('event', null, ['class' => 'form-control']) }}
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		{{ Form::label('start_id_order', 'Número inicial dos pedidos') }}
		{{ Form::number('start_id_order', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-6">
		{{ Form::label('number_sheets', 'Número de vias a ser impresso') }}
		{{ Form::number('number_sheets', null, ['class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('note', 'Observação') }}
	{{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => '"Nossos pedidos serão entregues de acordo com disponibilidade de estoque"']) }}
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
		{{ Form::label('email_from', 'Remetente') }}
		{{ Form::text('email_from', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-6">
		{{ Form::label('email_subject', 'Assunto') }}
		{{ Form::text('email_subject', null, ['class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('email_note', 'Mensagem do corpo do email') }}
	{{ Form::textarea('email_note', null, ['class' => 'form-control']) }}
</div>
{{ Form::submit('SALVAR', ['class' => 'btn btn-danger btn-lg']) }}
{{ Form::close() }}