<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Portal\Entities\Event;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Status;

class EventValidation extends Pivot
{
	protected $fillable = ['id', 'original_file', 'debug_file', 'clean_file', 'report', 'validated', 'modified', 'duplicates', 'failures', 'file', 'status_id', 'update'];

	protected $dates = ['update'];

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function validation()
	{
		return $this->belongsTo(Validation::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
