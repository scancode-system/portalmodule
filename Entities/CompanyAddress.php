<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
	protected $fillable = ['id', 'company_id', 'address', 'neighborhood', 'city', 'st', 'zip_code'];
}
