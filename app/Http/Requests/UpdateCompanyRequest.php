<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'responsible_id' => 'sometimes|required|integer|exists:user,id',
            'licensed' => 'sometimes|boolean',
        ];
    }
    public function messages(){
        return[
            'name.required' => 'O nome da empresa é obrigatorio',
            'name.max' => 'O nome pode ter no maximo :max caracteres',
            'responsible_id.required' => 'o Campo responsavel e obrigatorio',
            'responsible_id.required' => 'o Usuario nao existe',
            'licensed.boolean' => 'O campo licended deve ser booleano',
        ];
    }
}
