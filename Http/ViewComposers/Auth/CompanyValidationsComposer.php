<?php

namespace Modules\Portal\Http\ViewComposers\Auth;

use Illuminate\View\View;

class CompanyValidationsComposer {

    private $company_validations;

    public function compose(View $view) {
        $this->bootstrap();
        $view->with('company_validations', $this->company_validations);
    }

    private function bootstrap(){
        $this->company_validations();
    }

    private function company_validations(){
        $this->company_validations = auth()->user()->company_validations()->with('validation')->get();
    }

}
