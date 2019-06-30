<?php

namespace Modules\Portal\Http\Controllers;

use Modules\Portal\Http\Requests\ClientSettingRequest;
use Modules\Portal\Http\Controllers\BaseController;
use Modules\Portal\Entities\SystemSetting;

class SystemSettingController extends BaseController
{

    public function update(ClientSettingRequest $request, SystemSetting $system_setting){
        $system_setting->update($request->all());
        return redirect()->route('portal.main', ['tab' => 2])->with('success_client_setting', 'Seucesso: dados de configuração foram atualizados.');       

    }

}
