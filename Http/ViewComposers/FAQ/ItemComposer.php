<?php

namespace Modules\Portal\Http\ViewComposers\FAQ;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class ItemComposer extends SuperComposer {

    private $faq_topic;
    private $faq_items;

    public function view($view){
        $view->with('faq_topic', $this->faq_topic);
        $view->with('faq_items', $this->faq_items);
    }

    public function assign($view){
        $this->faq_topic();
        $this->faq_items();
    }

    public function faq_topic(){
        $this->faq_topic = request()->route('faq_topic');
    }

    public function faq_items(){
        $this->faq_items = $this->faq_topic->faq_items;
    }

}
