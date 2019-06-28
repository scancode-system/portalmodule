<?php

namespace Modules\Portal\Http\ViewComposers\Auth;

use Illuminate\View\View;

class ClientValidationsComposer {

    private $client_validations;

    public function compose(View $view) {
        $this->bootstrap();
        $view->with('client_validations', $this->client_validations);
    }

    private function bootstrap(){
        $this->client_validations();
    }

    private function client_validations(){
        $this->client_validations = auth()->user()->company_validations()->with('validation')->get();
    }

}
