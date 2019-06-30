<?php

namespace Modules\Portal\Http\ViewComposers\Validation;

use Illuminate\View\View;

class LoadingComposer {

    protected $company_validation;


    protected $porcent;
    protected $legend;
    protected $text;

    protected $complete;
    protected $is_success;
    protected $color;

    protected $export;

    public function compose(View $view) {
        $this->init();
        $this->porcent();
        $this->complete();
        $this->legend();
        $this->text();
        $this->color();

        $view->with('porcent', $this->porcent);
        $view->with('legend', $this->legend);
        $view->with('text', $this->text);
        $view->with('complete', $this->complete);
        $view->with('is_success', $this->is_success);
        $view->with('color', $this->color);
        $view->with('export', $this->export);
        $view->with('company_validation', $this->company_validation);
    }

    protected function init(){
        $this->company_validation = request()->route('company_validation');
        $this->is_success = session('validation.'.$this->company_validation->id.'.result', false);
        $this->export = session('validation.'.$this->company_validation->id.'.export', false);
    }

    protected function porcent(){     
        $this->porcent = session('validation.'.$this->company_validation->id.'.loaded', 0);
    }

    protected function complete(){     
        $this->complete = ($this->porcent==100);
    }

    protected function legend(){
        $legend = 'arquivo sendo carregado';

        if($this->porcent > 0 && $this->porcent < 100) {
            $legend = 'arquivo sendo validado';
        } else if ($this->porcent == 100) {
            $legend = 'validação concluida';
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
}
