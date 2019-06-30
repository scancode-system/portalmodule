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
		$company->token = base64_encode($company->email.':'.$company->password);
		$company->password = Hash::make($company->password);
	}

	public function created(Company $company) {
		$validations = Validation::all();
		foreach ($validations as $validation) {
			$company->validations()->attach($validation);
		}

		CompanyInfo::create(['company_id' => $company->id]);
		CompanyAddress::create(['company_id' => $company->id]);
		
		SystemSetting::create(['company_id' => $company->id]);
	}

}
