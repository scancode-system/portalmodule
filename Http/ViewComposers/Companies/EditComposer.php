<?php

namespace Modules\Portal\Http\ViewComposers\Companies;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class EditComposer extends SuperComposer {

    private $tab;
    private $company_info;
    private $company_address;

    public function view($view){
        $view->with('tab', $this->tab);
        $view->with('company_info', $this->company_info);
        $view->with('company_address', $this->company_address);
    }

    public function assign($view){
        $this->tab();
        $this->company_info();
        $this->company_address();
    }

    public function tab(){
        $this->tab = request()->route('tab');
    }

    public function company_info(){
        $this->company_info = auth()->user()->company_info;
    }

    public function company_address(){
        $this->company_address = auth()->user()->company_address;
    }

}
