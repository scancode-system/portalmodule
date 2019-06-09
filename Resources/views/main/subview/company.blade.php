@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session()->get('message') }}
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
<h3>DADOS DA EMPRESA</h3>
<hr>
{{ Form::model($company, ['route' => ['portal.company.update', $company], 'method' => 'PUT']) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('cnpj', 'CNPJ') }}
			{{ Form::text('cnpj', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('company_name', 'Razão Social') }}
			{{ Form::text('company_name', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('trade_name', 'Nome Fantasia') }}
			{{ Form::text('trade_name', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('state_registration', 'Inscrição Estadual') }}
			{{ Form::text('state_registration', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('phone', 'Telefone') }}
			{{ Form::text('phone', null, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('SALVAR', ['class' => 'btn btn-danger btn-lg']) }}
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::label('address', 'Rua') }}
			{{ Form::text('address', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('neighborhood', 'Bairro') }}
			{{ Form::text('neighborhood', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('city', 'Cidade') }}
			{{ Form::text('city', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('st', 'Estado') }}
			{{ Form::text('st', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('zip_code', 'CEP') }}
			{{ Form::text('zip_code', null, ['class' => 'form-control']) }}
		</div>
	</div>
</div>
{{ Form::close() }}