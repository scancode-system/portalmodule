<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\SystemSetting;
use Modules\Portal\Entities\Event;
use Modules\Portal\Entities\EventSetting;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Entities\Setting;
use Modules\Portal\Entities\Append;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\PortalAdmin\Emails\CreateEventEmail;

use Modules\SettingEmailGmail\Entities\SettingEmailGmail;

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

		$settings = Setting::all();
		foreach ($settings as $setting) {
			$event->settings()->attach($setting);
		}	

		/*$appends = Append::all();
		foreach ($appends as $append) {
			$event->appends()->attach($append);
		}*/	

		Mail::to($company->email)->queue(new CreateEventEmail($company, $event));
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

	public function deleting(Event $event){
		$event_settings = $event->event_settings;
		foreach ($event_settings as $event_setting) {
			$event_setting->delete();
		}
	}

}


