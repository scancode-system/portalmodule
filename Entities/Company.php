<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
	protected $fillable = ['id', 'cnpj', 'company_name', 'trade_name', 'state_registration', 'phone', 'address', 'neighborhood', 'city', 'st', 'zip_code', 'client_id'];

}
