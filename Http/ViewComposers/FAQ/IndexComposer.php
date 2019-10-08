<?php

namespace Modules\Portal\Http\ViewComposers\FAQ;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;
use Modules\Portal\Entities\FaqTopic;

class IndexComposer extends SuperComposer {

    private $faq_topics;

    public function view($view){
        $view->with('faq_topics', $this->faq_topics);
    }

    public function assign($view){
        $this->faq_topics();
    }

    public function faq_topics(){
        $this->faq_topics = FaqTopic::all();
    }

}
