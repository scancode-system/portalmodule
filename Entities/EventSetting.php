<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Portal\Entities\Event;
use Modules\Portal\Entities\Setting;

class EventSetting extends Pivot
{
    protected $fillable = [];

    public function configurable()
    {
        return $this->morphTo();
    }

    public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function setting()
	{
		return $this->belongsTo(Setting::class);
	}

    public function createSettingConfigurable($module){
    	$class = 'Modules\\'.$module.'\Entities\\'.$module;
		$custom_setting =  new $class();
		$custom_setting->save();
		return $custom_setting;
    }
}
