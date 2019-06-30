<?php

namespace Modules\Portal\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Portal\Entities\CompanyValidation;
use Modules\Portal\Entities\Validation;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{

	use Notifiable;


	protected $guard = 'company';

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function validations()
	{
		return $this->belongsToMany(Validation::class)->using(CompanyValidation::class)->as('company_validation')->withPivot(['status_id', 'file', 'update']);
	}

	public function company_validations()
	{
		return $this->hasMany(CompanyValidation::class);
	}

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

}
