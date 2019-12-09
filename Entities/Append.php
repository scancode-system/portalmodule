<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\Validation;


class Append extends Model
{
	protected $fillable = ['validation_id', 'module', 'alias'];

	public function validation()
	{
		return $this->belongsTo(Validation::class);
	}

	public function getModuleAliasAttribute()
	{
		return strtolower($this->module);
	}
	
}
