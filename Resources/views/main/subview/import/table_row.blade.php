<tr>
	<th class="align-middle lead pl-4 w-25"><a href="{{ route('portal.import', $company_validation) }}" class="text-dark nav-link p-0 text-capitalize">{{ ($key+1) }} - Importar {{ $company_validation->validation->alias }}</a></th>
	<td class="text-center"><a href="{{ route('portal.doc', $company_validation) }}" class="text-dark"><i class="fa fa-file-pdf-o fa-3x text-danger"></i> </a></td>
	<td class="text-center"><a href="{{ $company_validation->validation->video }}" class="text-dark" target="_blank"><i class="fa fa-play-circle fa-3x text-danger"></i></a></td>
	<td class="text-center align-middle w-25"><span class="badge badge-{{ $badge_color }} badge-pill px-4 py-1 text-uppercase" >{{ $badge_text }}</span></td>
	<td class="text-center align-middle lead w-25">{{ $date_text }}</td>
</tr>