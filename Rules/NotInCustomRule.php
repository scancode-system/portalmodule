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
        foreach ($this->values as $index => $item_value) {
            // se necessario modificar nao muda o operator ===, mas coloque funções entre variaveis, igual struppercase() exemplo
            if($item_value === $value){
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
