<div class="card-footer">
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
	<div class="d-flex">
		<div id="dropzone-import-{{ $event_validation->id }}" class="dropzone flex-fill">
			<div class="dz-message m-0">
				{{ Form::button('<i class="fa fa-upload fa-lg fa-2x text-white"></i>', ['type' => 'submit', 'class' => 'btn btn-success w-100']) }}
			</div>
		</div>
		<a href="#" id="btn-play_{{ $event_validation->id }}" class="flex-fill btn btn-primary mx-2" data-toggle="modal" data-target="#video-{{ $event_validation->id }}"><i class="fa fa-play-circle fa-lg fa-2x"></i></a>

		<div class="flex-fill text-center" id="btn-clean_{{ $event_validation->id }}">
			{{ Form::open(['route' => ['imports.widget.clean', $event_validation->id], 'method' => 'put']) }}
			{{ Form::button('<i class="fa fa-trash fa-lg fa-2x"></i>', ['type' => 'submit', 'class' => 'btn  w-100 btn-danger']) }}
			{{ Form::close() }}
		</div>
		@include('portal::imports.widget.subviews.dropzone.dropzone')
	</div>
	<div class="errors_{{ $event_validation->id }}"></div>
	@endif
</div>




<div class="modal fade" id="video-{{ $event_validation->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body overflow-auto">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="{{ $event_validation->validation->video }}" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>











@if($event_validation->original_file)
@endif