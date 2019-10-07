<div class="card-footer d-flex">
	@if($in_progress)
	@if($porcent != 100)
	<div class="progress-group mb-0 flex-fill">
		<div class="progress-group-header">
			<div class="text-capitalize">{{ $legend }}</div>
			<div class="ml-auto font-weight-bold">{{ $porcent }}%</div>
		</div>
		<div class="progress-group-bars">
			<div class="progress progress-xs bg-secondary">
				<div class="progress-bar bg-primary" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>

	@else
	<div class="progress-group mb-0 flex-fill">
		<div class="progress-group-header">
			<div class="text-capitalize">{{ $legend_animated }}</div>
		</div>
		<div class="progress-group-bars">
			<div class="progress progress-xs bg-secondary">
				<div class="progress-bar progress-bar-striped {{ $progress_bar_animated }}" role="progressbar" style="width: {{ $porcent  }}%" aria-valuenow="{{ $porcent }}" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	@endif
	@else
	<div id="dropzone-import-{{ $event_validation->id }}" class="dropzone flex-fill">
		<div class="dz-message m-0">
			@if($event_validation->original_file)
			{{ Form::button('<i class="fa fa-upload fa-lg fa-2x text-white"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-primary']) }}
			@else
			{{ Form::button('<i class="fa fa-upload fa-lg fa-2x text-white"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-secondary']) }}
			@endif
		</div>
	</div>
	@if($event_validation->original_file)
	<div class="flex-fill text-center pl-2" id="btn-clean_{{ $event_validation->id }}">
		{{ Form::open(['route' => ['imports.widget.clean', $event_validation->id], 'method' => 'put']) }}
		{{ Form::button('<i class="fa fa-trash fa-lg fa-2x"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-danger']) }}
		{{ Form::close() }}
	</div>
	@endif
	<div class="errors_{{ $event_validation->id }}"></div>
	@include('portal::imports.widget.subviews.dropzone.dropzone')
	@endif
</div>










