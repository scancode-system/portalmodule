@extends('portal::layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="card-title font-weight-bold">BEM VINDO, {{ auth('client')->user()->name }}</h1>
                        <p class="lead">
                            Esse é o seu portal de cliente, aqui você encontra todos os passos
                            para realizar o seu evento, de forma tranquila e eficiente.
                        </p>
                        <p class="lead">
                            Vamos lhe acompanhar em todo processo de validação, integração,
                            e exportação de arquivos.
                        </p>
                        <p class="lead">
                            Assista nosso video ao lado e saiba mais sobre o seu portal de cliente.
                        </p>
                        <h1 class="card-title font-weight-bold">DUVIDAS?</h1>
                        <p class="lead">Acesse nossa documentação e tutoriais</p>
                        <a href="{{ route('portal.dashboard') }}" class="btn btn-warning btn-lg text-white py-4 mr-2">VIDEOS TUTORIAIS</a>
                        <a href="{{ route('portal.dashboard') }}" class="btn btn-danger btn-lg py-4">DOCUMENTOS EM PDF</a>
                    </div>
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/sd5Rd4LRGgs?rel=0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-deck mb-3">
    <div class="card text-white bg-primary">
        <div class="card-header font-weight-bold text-center">IMPORTAR E VALIDAR SEUS DADOS</div>
        <div class="card-body px-4">
            <p class="lead text-center py-3">
                Faça a importação e validação dos seus dados, baixe nossas
                planilhas de exemplo, preencha com suas informações, e
                muito mais.
            </p>
            <ul class="list-group list-group-flush list-group-accent mb-4">
                @each('portal::dashboard.subviews.item_client_validation', $client_validations, 'client_validation')
            </ul>
            <a href="{{ route('portal.main', 0) }}" class="btn btn-danger btn-lg btn-block">INICIAR PASSO A PASSO</a>
        </div>
    </div>
    <div class="card text-white bg-info">
        <div class="card-header font-weight-bold text-center">INTEGRE AO SEU ERP</div>
        <div class="card-body px-5">
            <p class="lead text-center py-3">
                Baixe nossa documentação e mostre ao responsavel pelo seu TI,
                com isso você poderá realizar a importação dos pedidos realizados
                em feira direto ao seu sistema.
            </p>
            <div class="row">
                <div class="col-md-6 border-right">
                    <a href="{{ route('portal.dashboard') }}" class="btn text-white my-5 w-100">
                        <div class="font-weight-bold h3 mb-3">Integração via TXT</div>
                        <i class="fa fa-download fa-4x"></i>
                  </a>
              </div>
              <div class="col-md-6">
                <p class="lead my-4">
                    Baixe noso modelo de importação .TXT
                    Layout simples de importação.
                </p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection