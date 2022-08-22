<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'message' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
          'name.required' => "Имя не введено",
          'email.required' => "Email не введен",
          'email.email' => "Поле Email не является электронной почтой",
          'message.required' => "Заявка пуста",
        ];
    }
}
