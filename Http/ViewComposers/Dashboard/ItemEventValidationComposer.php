<?php

namespace Modules\Portal\Http\ViewComposers\Dashboard;

use Illuminate\View\View;
use \stdClass;

class ItemEventValidationComposer {

    private $data;

    private $badge_color;
    private $badge_text;

    public function compose(View $view) {
    	$this->data($view);

        $this->badge_color();
        $this->badge_text();

        $view->with('badge_color', $this->badge_color);
        $view->with('badge_text', $this->badge_text);
    }

    private function badge_color(){
        $this->badge_color = $this->data->badge_color;
    }

    private function badge_text(){
        $this->badge_text = $this->data->badge_text;
    }

    private function data($view){
        $this->data = new stdClass;

        switch ($view->event_validation->status_id) {
            case 1:
            $this->data->badge_color = 'danger';
            $this->data->badge_text = 'pendente';
            break;

            case 2:
            $this->data->badge_color = 'success';
            $this->data->badge_text = 'completo';
            break;          
        }
    }

}
