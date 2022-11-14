<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'max:100000'],
            'name' => ['required', 'string', 'max:55'],
            'phone' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Введите сумму',
            'amount.max' => 'Введите корректную сумму',
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите телефон',
        ];
    }
}
