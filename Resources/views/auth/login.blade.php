@extends('portal::layouts.auth')

@section('content')
<div class="col-md-8">
    <div class="card-group">
        <div class="card p-4">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--
                    <h1>Login</h1>
                    <p class="text-muted">Entre com a sua conta</p>
                    -->
                    <div class="d-flex justify-content-center mb-5">
                        <img class="mx-autod" src="{{ url('modules/portal/img/brand/logo.svg') }}"  height="75" alt="Scancode Logo">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-people"></i>
                            </span>
                        </div>
                        {{ Form::select('guard', ['company' => 'Empresa', 'admin' => 'Administrador'], null, ['class' => 'form-control']) }}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-envelope"></i>
                            </span>
                        </div>
                        {{ Form::email('email', old('email'), ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'E-mail', 'required' => 'required' ]) }}
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        {{ Form::password('password', ['class' => 'form-control'.($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required' ]) }}
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            {{ Form::submit('Entrar', ['class' => 'btn btn-primary px-4']) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
