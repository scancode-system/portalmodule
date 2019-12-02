<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\CompanyRequest;
use Modules\Portal\Http\Requests\CompanyInfoRequest;
use Modules\Portal\Http\Requests\CompanyAddressRequest;
use Modules\Portal\Entities\Company;
use Modules\Portal\Entities\CompanyInfo;
use Modules\Portal\Entities\CompanyAddress;
use Modules\Portal\Http\Controllers\BaseController;

class CompanyController extends BaseController
{

	public function __construct()
	{
		$this->middleware('auth:company');
	}

	public function edit(Request $request, Company $company, $tab){
		return view('portal::companies.edit');
	}

	public function update(CompanyRequest $request, Company $company){
		$company->update($request->all());
		return back()->with('success_login', 'Sucesso: seus dados foram atualizados.');		
	}

	public function updateInfo(CompanyInfoRequest $request, CompanyInfo $company_info){
		$company_info->update($request->all());
		return back()->with('success_info', 'Sucesso: seus dados foram atualizados.');		
	}

	public function updateAddress(CompanyAddressRequest $request, CompanyAddress $company_address){
		$company_address->update($request->all());
		return back()->with('success_address', 'Sucesso: seus dados foram atualizados.');		
	}

}
