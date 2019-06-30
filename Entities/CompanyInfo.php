<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = ['id', 'company_id', 'cnpj', 'company_name', 'trade_name', 'state_registration', 'ddd', 'phone',];
}
