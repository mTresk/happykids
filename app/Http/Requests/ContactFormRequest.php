<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:55'],
            'phone' => ['required', 'string'],
            'age' => ['required', 'numeric', 'max:18']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите телефон',
            'age.required' => 'Введите возраст',
            'age.max' => 'Введите корректный возраст',
        ];
    }
}
