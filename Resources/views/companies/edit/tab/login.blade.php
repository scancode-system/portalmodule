@if(session()->has('success_login'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session()->get('success_login') }}
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
{{ Form::Model(auth()->user(), ['route' => ['portal.company.update', auth()->user()], 'method' => 'PUT']) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('name', 'Nome') }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Bairro') }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
	</div>
</div>
{{ Form::close() }}