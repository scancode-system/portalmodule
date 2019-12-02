@if($layout == 'empty')
@include('portal::validation.subviews.empty')
@elseif($layout == 'complete')
@include('portal::validation.subviews.complete')
@elseif($layout == 'progress')
@include('portal::validation.subviews.progress')
@elseif($layout == 'progress_complete')
@include('portal::validation.subviews.progress_complete')
@endif