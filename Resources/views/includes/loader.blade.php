@foreach(Module::allEnabled() as $module)
@includeIf($module->getLowerName().'::loader.'.$loader_path)
@endforeach    