<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\User;
use Modules\Portal\Entities\UserValidation;

class Validation extends Model
{
	protected $fillable = ['id', 'alias', 'video', 'file', 'validation', 'module_name', 'module_alias'];



/*
	public function clients()
	{
		return $this->belongsToMany(Client::class)->using(ClientValidation::class)->as('client_validation')->withPivot(['status_id', 'file', 'update']);
	}*/
}
