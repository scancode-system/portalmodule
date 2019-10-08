<?php
/* PODE DELETAR ESTE COMPOSER */
namespace Modules\Portal\Http\ViewComposers\SystemSetting;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class IndexComposer extends SuperComposer {

    private $system_setting;

    public function view($view){
        $view->with('system_setting', $this->system_setting);
    }

    public function assign($view){
        $this->system_setting();
    }

    private function system_setting(){
        $this->system_setting = auth('company')->user()->event->system_setting;
    }

}
