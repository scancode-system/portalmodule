<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\RequestEvent;
use Illuminate\Http\Response;
use Modules\Portal\Http\Controllers\BaseController;
use Modules\Portal\Entities\Event;

class EventController extends BaseController
{
    public function index()
    {
        return view('portal::events.index');
    }

    public function store(RequestEvent $request)
    {
        Event::create($request->all());
        return back()->with('success_events', 'Sucesso: seus dados foram atualizados.');
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return back()->with('success_events', 'Sucesso: seus dados foram atualizados.');
    }    

    public function updateParameterless(Request $request)
    {
        $event = Event::find($request->id_event);
        if($event){
            $event->update($request->all());
        }
        return back();
    }


    public function destroy(Request $request, Event $event)
    {
        $event->delete();
        return back()->with('success_events', 'Sucesso: seus dados foram atualizados.');
    }
}
 