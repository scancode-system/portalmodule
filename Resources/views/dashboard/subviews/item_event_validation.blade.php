<li class="list-group-item bg-primary font-weight-bold d-flex justify-content-between align-items-center">
	<a href="{{ route('portal.import', 1) }}" class="text-white">{{ ($key+1) }} - Importar {{ $event_validation->validation->alias }}</a>
	<span class="badge badge-{{ $badge_color }} badge-pill px-3 py-1 text-uppercase" >{{ $badge_text }}</span>
</li>