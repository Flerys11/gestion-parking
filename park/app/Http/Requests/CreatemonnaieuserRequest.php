<?php

namespace App\Http\Requests;

use App\Models\monnaieuser;
use Illuminate\Foundation\Http\FormRequest;

class CreatemonnaieuserRequest extends FormRequest
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
            'monnaie_entre' => 'required|max:10',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'monnaie_entre.required' => 'Le champ Monnaie Entre est obligatoire.',
            'monnaie_entre.max' => 'La Monnaie Entre ne peut pas dépasser :max caractères.',
        ];
    }
}
