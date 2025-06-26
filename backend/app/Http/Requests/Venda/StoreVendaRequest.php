<?php

namespace App\Http\Requests\Venda;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreVendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendedor_id' => 'required|exists:vendedors,id',
            'valor' => 'required|numeric|min:0.01',
            'data' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'vendedor_id.required' => 'O vendedor é obrigatório.',
            'vendedor_id.exists' => 'Vendedor não encontrado.',
            'valor.required' => 'O valor da venda é obrigatório.',
            'data.required' => 'A data é obrigatória.',
            'data.date' => 'A data deve estar em formato válido.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'mensagem' => 'Erro de validação.',
            'erros' => $errors,
        ], 422, [], JSON_UNESCAPED_UNICODE));
    }
}
