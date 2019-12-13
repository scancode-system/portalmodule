<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Portal\Entities\EventSetting;
use Modules\Portal\Http\Controllers\BaseController;


class EventSettingController extends BaseController
{


    public function update(Request $request, EventSetting $event_setting)
    {
        $event_setting->alert = false;
        $event_setting->save();
        return back();
    }

}
