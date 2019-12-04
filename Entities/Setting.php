<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['module', 'alias'];


    public function getModuleAliasAttribute()
	{
		return strtolower($this->module);
	}
}
