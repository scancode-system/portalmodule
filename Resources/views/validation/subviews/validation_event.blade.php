@if($layout == 'empty')
@include('portal::validation.subviews.empty')
@elseif($layout == 'complete')
@include('portal::validation.subviews.complete')
@elseif($layout == 'progress')
@include('portal::validation.subviews.progress')
@endif