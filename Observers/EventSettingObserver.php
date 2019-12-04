<?php

namespace Modules\Portal\Observers;

use Modules\Portal\Entities\EventSetting;


class EventSettingObserver {

	public function creating(EventSetting $event_setting) {
		$module = $event_setting->setting->module;
		$class = 'Modules\\'.$module.'\Entities\\'.$module;
		$custom_setting =  new $class();
		$custom_setting->save();

		$event_setting->configurable()->associate($custom_setting);
	}


	public function deleted(EventSetting $event_setting){
		$event_setting->configurable->delete();
	}

}


