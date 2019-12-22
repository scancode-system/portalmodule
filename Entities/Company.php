<?php

namespace Modules\Portal\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Portal\Entities\CompanyValidation;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Event;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{

	use Notifiable;

	protected $dateFormat = 'Y-m-d H:i:s';


	protected $guard = 'company';

	protected $fillable = [
		'name', 'email', 'password', 'observation'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function company_info()
	{
		return $this->hasOne('Modules\Portal\Entities\CompanyInfo');
	}

	public function company_address()
	{
		return $this->hasOne('Modules\Portal\Entities\CompanyAddress');
	}

	public function system_setting()
	{
		return $this->hasOne('Modules\Portal\Entities\SystemSetting');
	}

	public function events()
	{
		return $this->hasMany(Event::class);
	}

	public function getEventAttribute($value)
	{
		$event = $this->events()->where('selected', 1)->first();
		return ($event)?$event:null;
	}

}
