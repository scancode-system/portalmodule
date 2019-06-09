<?php

namespace Modules\Portal\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;

class UniqueCustomValuesRule implements Rule
{

    private $parameters;
    private $validator;
    private $custom_values;
    private $data;

    private $fields;
    private $values;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parameters, Validator $validator)
    {
        $this->parameters = $parameters;
        $this->validator = $validator;
        $this->custom_values = $validator->customValues;
        $this->data = $validator->getData();

        $this->fields = [];
        $this->values = [];
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
        $count = 0;
        $size = count($this->custom_values[$attribute]);

        if(count($this->parameters) == 0){
            $this->parameters = [$attribute];
        }

        for($index = 0;$index < $size; $index++) {

            $found = true;

            foreach ($this->parameters as $parameter) {
                if($this->custom_values[$parameter][$index] != $this->data[$parameter]){
                    $found = false;
                }
            }

            if($found) {
                $count++;
            }

            if($count > 1){
                break;
            }

        }

        return ($count<=1)?true:false;
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
