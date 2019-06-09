<?php

namespace Modules\Portal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidation extends FormRequest
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
            'extension' => 'required|in:' . $this->file->getClientOriginalExtension(),
            'file' => 'required',
        ];
    }

    public function messages() {
        return [
            'extension.in' => 'Arquivo precisa ser xlsx.',
            'file.in' => 'Arquivo precisa ser xlsx.'
        ];
    }
}
