<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\FaqItem;

class FaqTopic extends Model
{
	protected $fillable = ['id', 'title', 'note'];

	public function faq_items()
	{
		return $this->hasMany(FaqItem::class);
	}

}
