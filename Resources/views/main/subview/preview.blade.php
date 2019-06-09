<h3>PRÉVIA ONLINE</h3>
<hr>
<!--
<div class="row">
	<div class="col text-center">
		{{ Form::open(['route' => 'portal.dashboard']) }}
		{{ Form::submit('Solicitar Instalação do Sistema', ['class' => 'btn btn-danger btn-lg py-4 my-4']) }}
		{{ Form::close() }}
		<small class="form-text text-muted">
			Instamos o sistema dentro de uma prazo de 48 horas a partir da colicitação.
		</small>
	</div>
</div>
<hr>
-->
<table class="table table-bordered">
	<tbody>
		<!--
		<tr>
			<th>Endereço</th>
			<td><a href="http://www.scancode.com.br/casabonita">www.scancode.com.br/casabonita</a></td>
		</tr>
		<tr>
			<th>Login</th>
			<td>admin</td>
		</tr>
		<tr>
			<th>Senha</th>
			<td>123456</td>
		</tr>
		<tr>
			<th>Data da Sincronização</th>
			<td>15/05/2019</td>
		</tr>-->
		<tr>
			<th>Token</th>
			<td>{{ auth()->user()->token }}</td>
		</tr>
	</tbody>
</table>
<small class="form-text text-muted">
	Data da Sincronização* é a data em que o sistema <a href="http://www.scancode.com.br/xyz">www.scancode.com.br/casabonita</a> foi sincronizado com os arquivos e as informações disponibilizados neste portal.
</small>
<hr class="mb-0">