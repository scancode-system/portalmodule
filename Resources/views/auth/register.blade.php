@extends('portal::layouts.auth')

@section('content')
<div class="col-md-6">
    {{ Form::open(['route' => 'register']) }}
    <div class="card mx-4">
        <div class="card-body p-4">
            <h1>Cadastrar</h1>
            <p class="text-muted">Criar um novo cadastro</p>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon-user"></i>
                    </span>
                </div>
                {{ Form::text('name', old('name'), ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : '') , 'required' => 'required',  'autofocus' => 'autofocus', 'placeholder' => 'Nome']) }}
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                {{ Form::email('email', old('email'), ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : '') , 'required' => 'required', 'placeholder' => 'Email']) }}
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon-lock"></i>
                    </span>
                </div>
                {{ Form::password('password', ['class' => 'form-control'.($errors->has('password') ? ' is-invalid' : '') , 'required' => 'required', 'placeholder' => 'Senha']) }}
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon-lock"></i>
                    </span>
                </div>
                {{ Form::password('password_confirmation', ['class' => 'form-control' , 'required' => 'required', 'placeholder' => 'Confirmar senha']) }}
            </div>
        </div>
        <div class="card-footer p-4">
            <div class="row">
                {{ Form::submit('Criar uma nova conta', ['class' => 'btn btn-block btn-success']) }}
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection