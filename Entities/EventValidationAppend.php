<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Entities\Append;


class EventValidationAppend extends Pivot
{
    protected $fillable = [];

    
    public function event_validation()
	{
		return $this->belongsTo(EventValidation::class);
	}

	public function appendModel()
	{
		return $this->belongsTo(Append::class, 'append_id');
	}
}
