<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Portal\Entities\ClientValidation;
use Modules\Portal\Entities\Validation;

class Client extends Authenticatable
{

	use Notifiable;

	protected $guard = 'client';

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function validations()
	{
		return $this->belongsToMany(Validation::class)->using(ClientValidation::class)->as('client_validation')->withPivot(['status_id', 'file', 'update']);
	}

	public function client_validations()
	{
		return $this->hasMany(ClientValidation::class);
	}

	public function company()
	{
		return $this->hasOne('Modules\Portal\Entities\Company');
	}

	public function client_setting()
	{
		return $this->hasOne('Modules\Portal\Entities\ClientSetting');
	}

}
