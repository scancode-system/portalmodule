@if(session()->has('success_info'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session()->get('success_info') }}
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
{{ Form::Model($company_info, ['route' => ['portal.company.update.info', $company_info], 'method' => 'PUT']) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('cnpj', 'CNPJ') }}
			{{ Form::text('cnpj', $company_info->cnpj, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('company_name', 'Razão Social') }}
			{{ Form::text('company_name', $company_info->company_name, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('trade_name', 'Nome Fantasia') }}
			{{ Form::text('trade_name', $company_info->trade_name, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('state_registration', 'Inscrição Estadual') }}
			{{ Form::text('state_registration', $company_info->state_registration, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('phone', 'Telefone') }}
			{{ Form::text('phone', $company_info->phone, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
	</div>
</div>
{{ Form::close() }}