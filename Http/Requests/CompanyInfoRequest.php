<?php

namespace Modules\Portal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyInfoRequest extends FormRequest
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
            'cnpj' => 'string|max:14',
            'company_name' => 'string|max:191',
            'trade_name' => 'string|max:191',
            'state_registration' => 'string|max:191',
            'phone' => 'string|max:10',
        ];
    }

    
    public function attributes()
    {
        return [
            'cnpj' => 'CNPJ',
            'company_name' => 'Razão social',
            'trade_name' => 'Nome Fantasia',
            'state_registration' => 'Inscrição Estadual',
            'phone' => 'TelefoneJ',
        ];
    }

}
