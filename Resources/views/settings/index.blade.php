@extends('portal::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<nav>
					<div class="nav nav-tabs" role="tablist">
						@foreach($event_settings as $event_setting)
						<a class="nav-item nav-link {{ ($tab== $event_setting->setting->module )?'active':'' }}" href="{{ route('portal.settings.index', $event_setting->setting->module) }}" >{{ $event_setting->setting->alias }}</a>
						@endforeach
					</div>
				</nav>
			</div>
			<div class="card-body">
				<div class="tab-content">
					@foreach($event_settings as $event_setting)
					<div class="tab-pane {{ ($tab==$event_setting->setting->module)?'show active':'' }}" >
															@alert_errors()
					@alert_success()
						@includeIf($event_setting->setting->module_alias.'::settings.body', ['event_setting' => $event_setting])
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