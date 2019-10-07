@foreach($event_validations as $i => $event_validation)
@if($i%2==0)
@if($i!=0)
</div>
@endif
<div class="row">
	@endif

	<div class="col-sm-6 col-lg-6" id="container_{{ $event_validation->id }}">
		
		@include('portal::imports.widget.import', ['event_validation' => $event_validation->id])
	</div>

	@endforeach
	@if(count($event_validations) > 0)
</div>
@endif