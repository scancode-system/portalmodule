<?php

namespace Modules\Portal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:companies,name,'.$this->name,
            'email' => 'required|string|email|max:255|unique:companies,email,'.$this->email
        ];
    }

    
    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'Email'
        ];
    }

}
