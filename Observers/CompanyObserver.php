<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\CompanyInfo;
use Modules\Portal\Entities\CompanyAddress;
use Modules\Portal\Entities\SystemSetting;
use Modules\Portal\Entities\Validation;
use Illuminate\Support\Facades\Hash;

class CompanyObserver {


	public function creating(Company $company) {
		$company->password = Hash::make($company->password);
	}

	public function created(Company $company) {
		CompanyInfo::create(['company_id' => $company->id]);
		CompanyAddress::create(['company_id' => $company->id]);
	}

}
