<?php

namespace Modules\Portal\Services\Pos;

use Modules\Portal\Entities\Event;
use Illuminate\Support\Facades\Storage;

class PosService
{

    public static function downloadPdf(Event $event){
        return self::download(self::uri($event, 'pdf'));
    }

    public static function downloadXlsx(Event $event){
        return self::download(self::uri($event, 'xlsx'));
    }

    public static function downloadTxt(Event $event){
        return self::download(self::uri($event, 'txt'));
    }

    private static function download($uri){
        if(!Storage::exists($uri)){
            Storage::put($uri, '');
        }
        return Storage::download($uri);
    }

    private static function uri(Event $event, $zip_name){
        return 'companies/'.$event->company->id.'/'.$event->id.'/pos/'.$zip_name.'.zip';
    }

}
