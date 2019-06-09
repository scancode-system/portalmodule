<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\Client;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\ClientSetting;
use Illuminate\Support\Facades\Hash;

class ClientObserver {


	public function creating(Client $client) {
		$client->token = base64_encode($client->email.':'.$client->password);
		$client->password = Hash::make($client->password);
	}

	public function created(Client $client) {
		$validations = Validation::all();
		foreach ($validations as $validation) {
			$client->validations()->attach($validation);
		}

		Company::create(['client_id' => $client->id]);
		ClientSetting::create(['client_id' => $client->id, 'event' => '', 'note' => '', 'email_note' => '']);
	}

}
