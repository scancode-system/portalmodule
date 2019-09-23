<?php

namespace Modules\Portal\Http\ViewComposers\Validation;

use Illuminate\View\View;
use Modules\Portal\Entities\EventValidation;

class LoadingComposer {

    protected $event_validation;

    protected $required;
    protected $missing_titles;

    protected $porcent;
    protected $legend;
    protected $text;

    protected $progress_bar_animated;
    protected $legend_animated;

    protected $complete;
    protected $is_success;
    protected $color;

    protected $export;

    protected $layout;
    protected $in_progress;

    const LAYOUT_EMPTY = 'empty'; 
    const LAYOUT_COMPLETE = 'complete';
    const LAYOUT_PROGRESS = 'progress';


    public function compose(View $view) {
        $this->init($view);
        
        $this->required();
        $this->missing_headings();

        $this->porcent();
        $this->complete();
        $this->legend();
        $this->text();
        $this->color();
        $this->progress_bar_animated();
        $this->legend_animated();

        $this->layout();

        $view->with('required', $this->required);
        $view->with('missing_headings', $this->missing_headings);
        $view->with('porcent', $this->porcent);
        $view->with('legend', $this->legend);
        $view->with('text', $this->text);
        $view->with('complete', $this->complete);
        $view->with('is_success', $this->is_success);
        $view->with('color', $this->color);
        $view->with('export', $this->export);
        $view->with('event_validation', $this->event_validation);

        $view->with('progress_bar_animated', $this->progress_bar_animated);
        $view->with('legend_animated', $this->legend_animated);


        $view->with('in_progress', $this->in_progress);
        $view->with('layout', $this->layout);
    }

    protected function init($view){
        $this->event_validation = EventValidation::find($view->event_validation);
        $this->is_success = session('validation.'.$this->event_validation->id.'.result', false);
        $this->export = session('validation.'.$this->event_validation->id.'.export', false);
        //session(['validation.'.$this->event_validation->id.'.in_progress' => false]);
        //dd(session('validation.'.$this->event_validation->id.'.in_progress'));
        $this->in_progress = session('validation.'.$this->event_validation->id.'.in_progress2');

    }

    protected function required(){     
        $this->required =   session('validation.'.$this->event_validation->id.'.headings');                           
    }

    protected function missing_headings(){     
        $this->missing_headings = session('validation.'.$this->event_validation->id.'.missing_headings');                           
    }

    protected function porcent(){     
        $this->porcent = session('validation.'.$this->event_validation->id.'.loaded', 0);                         
    }

    protected function complete(){     
        $this->complete = ($this->porcent==100);
    }

    protected function legend(){
        $legend = 'arquivo sendo carregado';

        if($this->porcent > 0 && $this->porcent < 100) {
            $legend = 'arquivo sendo validado';
        } else if ($this->porcent == 100) {
            $legend = 'validação concluída';
        }

        $this->legend = $legend;
    }

    protected function text(){
        $text = '';

        if($this->complete && $this->is_success) {
            $text = 'parabéns sua tabela foi validada e importada com sucesso';
        } else if ($this->complete) {
            $text = 'sua tabela contém erros e não pode ser importada, faça download da planilha no botão abaixo. nelalhe mostraremos todos os erros, faça a correção necessárioa e tente validar novamente';
        }

        $this->text = $text;
    }

    protected function color(){
        $color = 'primary';

        if($this->complete && $this->is_success) {
            $color = 'success';
        } else if ($this->complete) {
            $color = 'danger';
        }

        $this->color = $color;
    }

    protected function progress_bar_animated(){
        $progress_bar_animated = '';
        if($this->porcent == 100 && !$this->export){
            $progress_bar_animated = 'progress-bar-animated';
        }

        $this->progress_bar_animated = $progress_bar_animated;
    }

    protected function legend_animated(){
        $legend_animated = 'arquivo sendo gerado';
        if($this->export){
            $legend_animated = 'arquivo gerado';
        }

        $this->legend_animated = $legend_animated;
    }


     protected function layout(){
        $layout = self::LAYOUT_EMPTY;
        if($this->in_progress){
                    $layout = self::LAYOUT_PROGRESS;
        }

        $this->layout = $layout;
    }
}
