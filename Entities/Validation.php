<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Portal\Entities\User;
use Modules\Portal\Entities\UserValidation;

class Validation extends Model
{
	protected $fillable = ['id', 'alias', 'video', 'file', 'validation', 'module_name', 'module_alias', 'import'];
}
