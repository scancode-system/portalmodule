<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\ClientSettingRequest;
use Modules\Portal\Entities\ClientSetting;
use Modules\Portal\Http\Controllers\BaseController;

class ClientSettingController extends BaseController
{
    

	public function update(ClientSettingRequest $request, ClientSetting $client_setting){
		$client_setting->update($request->all());
		return redirect()->route('main', ['tab' => 2])->with('success_client_setting', 'Seucesso: dados de configuração foram atualizados.');		

	}


}
