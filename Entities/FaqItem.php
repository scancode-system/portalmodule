<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\FaqTopic;

class FaqItem extends Model
{
	protected $fillable = ['id', 'title', 'text', 'faq_topic_id'];

	public function faq_topic()
	{
		return $this->belongsTo(FaqTopic::class);
	}

}
