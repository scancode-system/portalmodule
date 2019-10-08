<a  class="list-group-item list-group-item-action" data-toggle="collapse" href="#faq_item_{{ $faq_item->id }}">
	{{ $faq_item->title }}
</a>
<div class="collapse" id="faq_item_{{ $faq_item->id }}">
	<li class="list-group-item">
		{!! $faq_item->text !!}
	</li>
	<li class="list-group-item d-none">ddd</li>
</div>