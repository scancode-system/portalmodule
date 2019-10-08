@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="lead card-header text-uppercase">
				faq - perguntas frequentes
			</div>
			<div class="card-body">
				@foreach($faq_topics as $i => $faq_topic)
				@if($i%3==0)
				@if($i!=0)
			</div>
			@endif
			<div class="row">
				@endif

				<div class="col-sm-4 col-lg-4">

					<div class="card card-accent-info mb-3">
						<div class="card-header">{{ $faq_topic->title }}</div>
						<div class="card-body">
							<p class="card-text">
								{{ $faq_topic->note }}
							</p>
							<a href="{{ route('company.faq.items', $faq_topic->id) }}" class="btn btn-primary d-block">Clique aqui!</a>
						</div>
					</div>
				</div>

				@endforeach
				@if(count($faq_topics) > 0)
			</div>
			@endif
		</div>
	</div>
</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">FAQ</li>
@endsection