<div class="row">
	<div class="col" id="container_validation">
		@include('portal::validation.subviews.loading')		
	</div>
</div>


@push('scripts')
<script>
	$(document).ready(function(){
		var interval = setInterval(function(){
			$("#container_validation").load('{{ route('portal.validation.info', $client_validation) }}');
		}, 1000);

		$.post('{{ route('portal.validation.start', $client_validation) }}').always(function(data) {
			clearInterval(interval);
			$("#container_validation").html(data);
		});
	});
</script>
@endpush