<?php

namespace App\Http\Requests;

use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Filters extends FormRequest
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
            'status' => [
                Rule::in([Request::STATUS_RESOLVED, Request::STATUS_ACTIVE])
            ],
            'date_from' => 'date',
            'date_to' => 'date',
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'Указан не верный статус',
            'date_from.date' => 'Поле не является датой',
            'date_to.date' => 'Поле не является датой',
        ];
    }

    public function getDateFrom(): ?Carbon
    {
        return $this->date_from ? new Carbon($this->date_from) : null;
    }

    public function getDateTo(): ?Carbon
    {
        return $this->date_to ? new Carbon($this->date_to) : null;
    }
}
