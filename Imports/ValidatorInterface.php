<?php

namespace Modules\Portal\Imports;

interface ValidatorInterface {

	public function rule($data);

	public function messages();

}
