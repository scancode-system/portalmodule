<?php

namespace Modules\Portal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingRequest extends FormRequest
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
            'event' => 'string|max:191',
            'start_id_order' => 'integer|min:1',
            'number_sheets' => 'integer|min:1',
            'note' => 'string',
        ];
    }


    public function attributes()
    {
        return [
            'event' => 'Nome do Evento',
            'start_id_order' => 'Número inicial dos pedidos',
            'number_sheets' => 'úmero de vias a ser impresso',
            'note' => 'Observação'
        ];
    }

}
