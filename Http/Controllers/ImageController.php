<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Portal\Http\Controllers\BaseController;

class ImageController extends BaseController
{

	public function index(Request $request){
		return view('portal::images.index');
	}
    
	public function produtos(Request $request){
        Storage::disk('local')->putFileAs('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/produtos', $request->file, $request->file->getClientOriginalName());
	}

	public function logo(Request $request){
        Storage::disk('local')->putFileAs('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/logo', $request->file, 'logo.jpg');		
	}

	public function show(Request $request, $image_name){
		return response()->file(storage_path('app/companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/produtos/'.$image_name));
	}

	public function showLogo(Request $request){
		return response()->file(storage_path('app/companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/logo/logo.jpg'));
	}

	public function destroy(){
		$produtos = Storage::disk('local')->files('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/produtos');
		foreach ($produtos as $produto) {
			Storage::disk('local')->delete($produto);
		}
		return redirect()->route('portal.main', ['tab' => 4])->with('message_images', 'Seucesso: Imagens foram removidas.');			
	}

	public function destroyLogo(){
		Storage::disk('local')->delete('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/images/logo/logo.jpg');
		return redirect()->route('portal.main', ['tab' => 4])->with('message_images', 'Seucesso: Logo removido com sucesso.');			
	}

}
