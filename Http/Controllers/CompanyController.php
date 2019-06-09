<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\CompanyRequest;
use Modules\Portal\Entities\Company;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    
	public function update(CompanyRequest $request, Company $company){
		$company->update($request->all());
		return redirect()->route('portal.main', ['tab' => 0])->with('message', 'Seucesso: seus dados foram atualizados.');		
	}

}
