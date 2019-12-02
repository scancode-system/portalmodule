@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="lead card-header text-uppercase">
				documentos em pdf
			</div>
			<div class="card-body text-uppercase">
				<p class="lead text-center">
					baixe nossa documentação e configure suas planilhas da forma correta.
				</p>
				<div class="row">
					@foreach($event_validations as $event_validation)
					<div class="col">
						<a href="{{ route('portal.doc.download.pdf', $event_validation->validation) }}" class="btn my-5 w-100">
							<i class="mb-3 text-danger fa fa-file-pdf-o fa-4x"></i>
							<div class="">Documentação de {{ $event_validation->validation->alias }}</div>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">Documentações em PDF</li>
@endsection