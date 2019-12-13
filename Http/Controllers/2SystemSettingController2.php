<?php

namespace Modules\Portal\Http\Controllers;

use Modules\Portal\Http\Requests\SystemSettingRequest;
use Modules\Portal\Http\Controllers\BaseController;
use Modules\Portal\Entities\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends BaseController
{


	public function index(Request $request){
		return view('portal::system_settings.index');
	}


    public function update(SystemSettingRequest $request, SystemSetting $system_setting){
        $system_setting->update($request->all());
        return redirect()->route('portal.system_setting.index')->with('success_client_setting', 'Seucesso: dados de configuração foram atualizados.');       

    }

}
