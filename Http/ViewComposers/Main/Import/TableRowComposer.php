<?php

namespace Modules\Portal\Http\ViewComposers\Main\Import;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;
use \stdClass;

class TableRowComposer extends SuperComposer {

    protected $badge_color;
    protected $badge_text;
    protected $date_text;

    public function view($view){
        $view->with('badge_color', $this->badge_color);
        $view->with('badge_text', $this->badge_text);
        $view->with('date_text', $this->date_text);
    }

    public function assign($view){
        $this->badge_color();
        $this->badge_text();
        $this->date_text();
    }

    private function badge_color(){
        $this->badge_color = $this->data->badge_color;
    }

    private function badge_text(){
        $this->badge_text = $this->data->badge_text;
    }

    private function date_text(){
        if(is_null($this->data->company_validation->update)) {
            $this->date_text = 'Sem atualização';
        } else {
            $this->date_text = $this->data->company_validation->update->format('d/m/Y H:i:s');
        }
    }

    public function data($view){
        $this->data->company_validation = $view->company_validation;

        switch ($this->data->company_validation->status_id) {
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
