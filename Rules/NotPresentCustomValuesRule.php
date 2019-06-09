<?php

namespace Modules\Portal\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;

class NotPresentCustomValuesRule implements Rule
{

    private $parameters;
    private $custom_values;

    private $value;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parameters, Validator $validator)
    {
        $this->parameters = $parameters;
        $this->custom_values = $validator->customValues;
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
        $this->value = $value;
        $not_present = true;
        foreach ($this->parameters as $parameter) {
            $values = $this->custom_values[$parameter];
            foreach ($values as $value) {
                if($this->value == $value){
                    $not_present = false;
                }
            }
        }

        return $not_present;
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
