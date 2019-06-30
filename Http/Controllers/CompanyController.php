<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\CompanyInfoAddressRequest;
use Modules\Portal\Entities\CompanyInfo;
use Modules\Portal\Entities\CompanyAddress;
use Modules\Portal\Http\Controllers\BaseController;

class CompanyController extends BaseController
{
    
	public function updateCompanyInfoAddress(CompanyInfoAddressRequest $request, CompanyInfo $company_info, CompanyAddress $company_address){
		$company_info->update($request->all());
		$company_address->update($request->all());
		return redirect()->route('portal.main', ['tab' => 0])->with('message', 'Seucesso: seus dados foram atualizados.');		
	}

}
