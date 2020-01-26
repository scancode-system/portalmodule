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
        Storage::disk('local')->putFileAs('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/produtos', $request->file, $request->file->getClientOriginalName());
	}

	public function logo(Request $request){
        Storage::disk('local')->putFileAs('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/logo', $request->file, 'logo.png');		
	}

	public function show(Request $request, $image_name){
		return response()->file(storage_path('app/companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/produtos/'.$image_name));
	}

	public function showLogo(Request $request){
		return response()->file(storage_path('app/companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/logo/logo.png'));
	}

	public function destroy(){
		$produtos = Storage::disk('local')->files('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/produtos');
		foreach ($produtos as $produto) {
			Storage::disk('local')->delete($produto);
		}
		return back()->with('message_images', 'Seucesso: Logo removido com sucesso.');
	}

	public function destroyLogo(){
		Storage::disk('local')->delete('companies/'.auth()->user()->id.'/'.auth()->user()->event->id.'/clean/images/logo/logo.png');
		return back()->with('message_images', 'Seucesso: Logo removido com sucesso.');			
	}

}
