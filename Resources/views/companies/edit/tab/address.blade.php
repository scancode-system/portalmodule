@if(session()->has('success_address'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session()->get('success_address') }}
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
{{ Form::Model($company_address, ['route' => ['portal.company.update.address', $company_address], 'method' => 'PUT']) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('address', 'Rua') }}
			{{ Form::text('address', $company_address->address, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('neighborhood', 'Bairro') }}
			{{ Form::text('neighborhood', $company_address->neighborhood, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('city', 'Cidade') }}
			{{ Form::text('city', $company_address->city, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('st', 'Estado') }}
			{{ Form::text('st', $company_address->st, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('zip_code', 'CEP') }}
			{{ Form::text('zip_code', $company_address->zip_code, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
	</div>
</div>
{{ Form::close() }}