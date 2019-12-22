<li class="breadcrumb-menu  nav-item dropdown d-md-down-none">
	<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		<i class="icon-list"></i>
		<span class="badge badge-pill badge-{{ $badge_color }}" style="position: absolute;top: 50%;left: 50%;margin-top: -16px;margin-left: 0;">{{ $number_alert }}</span>
	</a>
	<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
		<div class="dropdown-header text-center">
			<strong>Importações</strong>
		</div>
		@foreach($event_validations as $event_validation)
		<a class="dropdown-item" href="{{ route('portal.imports') }}">
			<div class="small mb-1 text-capitalize">{{ $event_validation->validation->alias }} ({{ $event_validation->total_validations }}/{{ $event_validation->validated }})
				<span class="float-right">
					<strong>{{ round($event_validation->porcentage_completed) }}%</strong>
				</span>
			</div>
			<span class="progress progress-xs">
				<div class="progress-bar bg-{{ $event_validation->alert_color }} w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
			</span>
			<small></small>
		</a>
		@endforeach
	</div>
</li>