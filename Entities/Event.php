<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\SystemSetting;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\EventValidation;

class Event extends Model
{
	protected $fillable = ['id', 'company_id', 'name', 'selected'];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function system_setting()
	{
		return $this->hasOne(SystemSetting::class);
	}

		public function validations()
	{
		return $this->belongsToMany(Validation::class)->using(EventValidation::class)->as('event_validation')->withPivot(['status_id', 'file', 'update']);
	}

	public function event_validations()
	{
		return $this->hasMany(EventValidation::class);
	}

}
