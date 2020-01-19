@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<nav>
					<div class="nav nav-tabs" role="tablist">
						<a class="nav-item nav-link {{ ($tab=='home')?'active':'' }}" href="{{ route('portal.settings.index', 'home') }}" >Home</a>
						@foreach($event_settings as $event_setting)
						<a class="nav-item nav-link {{ ($tab== $event_setting->setting->module )?'active':'' }}" href="{{ route('portal.settings.index', $event_setting->setting->module) }}" >{{ $event_setting->setting->alias }}</a>
						@endforeach
					</div>
				</nav>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane {{ ($tab=='home')?'show active':'' }}" >
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xge6D2aCqcY?rel=0" allowfullscreen></iframe>
						</div>
					</div>
					@foreach($event_settings as $event_setting)
					<div class="tab-pane {{ ($tab==$event_setting->setting->module)?'show active':'' }}" >
						@alert_errors()
						@alert_success()
						@includeIf($event_setting->setting->module_alias.'::settings.body', ['event_setting' => $event_setting])
						@loader(['loader_path' => $event_setting->setting->module_alias.'.body'])
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
<li class="breadcrumb-item">Configuraçoes</li>
@endsection




@section('events')
@include('portal::layouts.subviews.events')
@endsection