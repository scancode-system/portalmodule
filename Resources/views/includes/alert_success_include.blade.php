@php if(!isset($key_message)) {$key_message = 'success';} @endphp
@if(session()->has($key_message))
<div class="alert alert-success alert-dismissible fade show">
	<strong>Sucesso! </strong>{!! session()->get($key_message) !!}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif