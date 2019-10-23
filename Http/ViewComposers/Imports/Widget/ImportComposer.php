<?php

namespace Modules\Portal\Http\ViewComposers\Imports\Widget;

use Illuminate\View\View;
use Modules\Portal\Entities\EventValidation;

class ImportComposer {

    protected $event_validation;

    protected $porcent;
    protected $legend;

    protected $progress_bar_animated;
    protected $legend_animated;

    protected $layout;
    protected $in_progress;

    protected $validated;
    protected $modified;
    protected $duplicates;
    protected $failures;

    const LAYOUT_EMPTY = 'empty'; 
    const LAYOUT_COMPLETE = 'complete';
    const LAYOUT_PROGRESS = 'progress';
    const LAYOUT_PROGRESS_COMPLETE = 'progress_complete';


    public function compose(View $view) {
        $this->init($view);
        
        $this->porcent();
        $this->legend();
        $this->progress_bar_animated();
        $this->legend_animated();

        $this->layout();

        $view->with('porcent', $this->porcent);
        $view->with('legend', $this->legend);
        $view->with('event_validation', $this->event_validation);

        $view->with('progress_bar_animated', $this->progress_bar_animated);
        $view->with('legend_animated', $this->legend_animated);

        $view->with('in_progress', $this->in_progress);
        $view->with('layout', $this->layout);

        $view->with('validated', $this->validated);
        $view->with('modified', $this->modified);
        $view->with('duplicates', $this->duplicates);
        $view->with('failures', $this->failures);
    }

    protected function init($view){
        $this->event_validation = EventValidation::find($view->event_validation);

        //session(['validation.'.$this->event_validation->id.'.in_progress2' => false]);
        //dd(session('validation.'.$this->event_validation->id.'.in_progress'));
        //dd(session('validation.'.$this->event_validation->id.'.in_progress2'));
        $this->in_progress = session('validation.'.$this->event_validation->id.'.in_progress2');
        //dd(session('validation.'.$this->event_validation->id.'.in_progress2'));

        if($this->in_progress){
            $this->validated = session('validation.'.$this->event_validation->id.'.validated');
            $this->modified = session('validation.'.$this->event_validation->id.'.modified');
            $this->duplicates = session('validation.'.$this->event_validation->id.'.duplicates');
            $this->failures = session('validation.'.$this->event_validation->id.'.failures');  
        }else {
            $this->validated =  $this->event_validation->validated;
            $this->modified = $this->event_validation->modified;
            $this->duplicates = $this->event_validation->duplicates;
            $this->failures = $this->event_validation->failures;
        }
    }


    protected function porcent(){     
        $this->porcent = session('validation.'.$this->event_validation->id.'.loaded', 0);                         
    }

    protected function legend(){
        $legend = 'arquivo sendo carregado';

        if($this->porcent > 0 && $this->porcent < 100) {
            $legend = 'arquivo sendo validado';
        } else if ($this->porcent == 100) {
            $legend = 'Arquivos sendo gerados';
        }

        $this->legend = $legend;
    }

    protected function progress_bar_animated(){
        $progress_bar_animated = '';
        if($this->porcent == 100){
            $progress_bar_animated = 'progress-bar-animated';
        }

        $this->progress_bar_animated = $progress_bar_animated;
    }

    protected function legend_animated(){
        $legend_animated = 'Novos arquivos sendo gerados';
        $this->legend_animated = $legend_animated;
    }


    protected function layout(){
        if($this->in_progress){
            $layout = self::LAYOUT_PROGRESS;
            if(!is_null($this->event_validation->original_file)){
                $layout = self::LAYOUT_PROGRESS_COMPLETE;
            }
        } else {
            $layout = self::LAYOUT_EMPTY;
            if(!is_null($this->event_validation->original_file)){
                $layout = self::LAYOUT_COMPLETE;
            }
        }

        $this->layout = $layout;
    }
}
