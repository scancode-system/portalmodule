<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Services\Pos\PosService;
use Modules\Portal\Http\Controllers\BaseController;


class PosController extends BaseController
{

    public function pdf(Request $request)
    {
        return PosService::downloadPdf(auth('company')->user()->event);
    }

    public function xlsx(Request $request)
    {
        return PosService::downloadXlsx(auth('company')->user()->event);
    }

    public function txt(Request $request)
    {
        return PosService::downloadTxt(auth('company')->user()->event);
    }

}
