<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'tel_number' => 'required|string|max:20',
        'res_date' => 'required|date_format:Y-m-d',

        'res_start_time' => 'required|date_format:H:i',
        'res_end_time' => 'required|date_format:H:i|after:res_start_time',
        'guest_number' => 'required|integer|min:1',
        'table_id' => 'required|exists:tabels,id',

        ];
    }
}
