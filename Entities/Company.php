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
		return $this->belongsToMany(Validation::class)->using(ClientValidation::class)->as('company_validation')->withPivot(['status_id', 'file', 'update']);
	}

	public function company_validations()
	{
		return $this->hasMany(CompanyValidation::class);
	}

/*	public function company_infos()
	{
		return $this->hasOne('Modules\Portal\Entities\Company');
	}

	public function client_setting()
	{
		return $this->hasOne('Modules\Portal\Entities\ClientSetting');
	}*/

	//protected $fillable = ['id', 'cnpj', 'company_name', 'trade_name', 'state_registration', 'phone', 'address', 'neighborhood', 'city', 'st', 'zip_code', 'client_id'];

}
