@extends('portal::layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="lead card-header text-uppercase">
				FAQ - {{ $faq_topic->title }}
			</div>
			<div class="card-body">
				<ul class="list-group">
				@each('portal::faq.item', $faq_items, 'faq_item', 'portal::faq.empty')
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('portal.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ route('company.faq') }}">FAQ</a>
</li>
<li class="breadcrumb-item">
	{{ $faq_topic->title }}
</li>
@endsection