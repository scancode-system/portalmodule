<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\ClientSetting;
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

		//Company::create(['client_id' => $client->id]);
		//ClientSetting::create(['client_id' => $client->id, 'event' => '', 'note' => '', 'email_note' => '']);
	}

}
