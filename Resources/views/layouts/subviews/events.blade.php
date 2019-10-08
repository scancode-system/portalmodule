<div class="btn-group mr-3" role="group" aria-label="Button group">
	{{ Form::Open(['route' => ['events.parameterless.update'], 'method' => 'put']) }}
	{{ Form::hidden('selected', 1) }}
	{{ Form::select('id_event', $events, $id_event, ['class' => 'form-control form-control-sm', 'id' => 'select_event_change']) }}
	{{ Form::Close() }}
</div>