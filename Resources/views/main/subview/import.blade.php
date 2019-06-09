<h3>IMPORTAR E VALIDAR (Dados)</h3>
<hr>
<p class="lead">
	Para importar seus arquivos baixe nossas planilhas de exemplo e preencha exatamente conforme comentários dentro da planilha
	em seguida faça o upload da planilha preenchida.
</p>
<table class="table table-striped table-borderless mb-0">
	<thead>
		@include('portal::main.subview.import.table_head')
	</thead>
	<tbody>
		@each('portal::main.subview.import.table_row', $client_validations, 'client_validation')
	</tbody>
</table>