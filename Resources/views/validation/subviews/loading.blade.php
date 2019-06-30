<div class="row my-5">
	<div class="col">
		<h3 class="mt-5 text-capitalize">{{ $legend }}</h3>
		<div class="progress mb-3">
			<div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $porcent }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<h1 class="display-2 text-center text-{{ $color }}">{{ $porcent }}%</h1>
		@if($complete && $is_success)
		<p class="lead my-5 text-center">PARABÉNS SUA TABELA FOI VALIDADA E IMPORTADA COM SUCESSO!</p>
		<div class="d-flex justify-content-center">
			<a href="{{ route('portal.main', 1) }}" class="btn btn-success btn-lg w-50">VOLTAR</a>
		</div>
		@elseif($complete)
		<p class="lead my-5 text-center">SUA TABELA CONTÉM ERROS E NÃO PODE SER IMPORTADA, FAÇA DOWNLOAD DA PLANILHA NO BOTÃO ABAIXO. NELA LHE MOSTRAREMOS TODOS OS ERROS, FAÇA A CORREÇÃO NESCESSÁRIA E TENTE VALIDAR NOVAMENTE</p>

		@if($export)
		<div class="d-flex justify-content-center">
			<a href="{{ route('portal.validation.download', $company_validation) }}" class="btn btn-danger btn-lg w-50 text-uppercase">BAIXAR TABELA DE {{ $company_validation->validation->alias }}</a>
		</div>
		@else
		<p class="text-center mb-1">Aguarde um momento...</p>
		<div class="progress w-25 ml-auto mr-auto">
			<div class="progress-bar progress-bar-striped progress-bar-animated w-100 bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		@endif
		@endif
	</div>
</div>

