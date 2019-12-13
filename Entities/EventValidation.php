<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Portal\Entities\Event;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Status;
use Modules\Portal\Entities\EventValidationAppend;


class EventValidation extends Pivot
{
	protected $fillable = ['id', 'original_file', 'debug_file', 'clean_file', 'report', 'validated', 'modified', 'duplicates', 'failures', 'status_id', 'update', 'start'];

	protected $dates = ['update', 'start'];

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

	public function event_validaton_appends()
	{
		return $this->hasMany(EventValidationAppend::class, 'event_validation_id');
	}

	public function getTotalValidationsAttribute($value)
	{
		return $this->validated+$this->failures;
	}


	public function getPorcentageCompletedAttribute($value)
	{
		if($this->total_validations == 0)
		{
			return 0;
		} else 
		{
			return ($this->validated/$this->total_validations)*100;
		}
	}

}
