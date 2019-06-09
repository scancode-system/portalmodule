<?php

namespace Modules\Portal\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;

class PresentWithRule implements Rule
{

    private $parameters;
    private $validator;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parameters, Validator $validator)
    {
        $this->parameters = $parameters;
        $this->validator = $validator;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exist = true;

        foreach ($this->parameters as $parameter) {
            if(!array_key_exists($parameter, $this->validator->getData())){
                $exist = false;
            }
        }

        return $exist;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
