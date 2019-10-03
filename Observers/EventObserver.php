<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\SystemSetting;
use Modules\Portal\Entities\Event;
use Modules\Portal\Entities\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\PortalAdmin\Emails\CreateEventEmail;

class EventObserver {

	public function creating(Event $event) {
		$company_events = $event->company->events;
		foreach ($company_events as $company_event) {
			if($company_event->selected == 1){
				$company_event->selected = 0;
				$company_event->save();
			}
		}
		
		$event->selected = 1;
	}

	public function created(Event $event) {
		$company = Company::find($event->company_id);
		$event->token = base64_encode($company->email.':'.base64_decode($company->password_64).':'.$event->id);
		$event->save();

		$validations = Validation::all();
		foreach ($validations as $validation) {
			$event->validations()->attach($validation);
		}

		SystemSetting::create(['event_id' => $event->id]);

		Mail::to($company->email)->queue(new CreateEventEmail());
	}

	public function updating(Event $event) {
		if($event->isDirty('selected')){
			if($event->selected != 0){
				$company_events = $event->company->events;
				foreach ($company_events as $company_event) {
					$company_event->selected = 0;
					$company_event->save();
				}
			}
			
		}
	}

}


		