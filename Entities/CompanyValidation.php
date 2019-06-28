<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Status;

class CompanyValidation extends Pivot
{

	protected $fillable = ['id', 'file', 'status_id', 'update'];

	protected $dates = ['update'];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function validation()
	{
		return $this->belongsTo(Validation::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

}
