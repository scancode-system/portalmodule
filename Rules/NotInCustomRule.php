<?php

namespace Modules\Portal\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;

class NotInCustomRule implements Rule
{

    private $values;
    private $message;

    public function __construct($values, $message = '')
    {
        $this->values =  $values;
        $this->message = $message;
    }


    public function passes($attribute, $value)
    {
        foreach ($this->values as $item_value) {
            if($item_value == $value){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
