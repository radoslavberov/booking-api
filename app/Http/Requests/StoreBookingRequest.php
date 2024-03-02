<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'room_id'           => 'required|integer|exists:rooms,id',
            'customer_id'       => 'required|integer|exists:customers,id',
            'check_in_date'     => 'required|date',
            'check_out_date'    => 'required|date|after_or_equal:check_in_date',
        ];
    }
}
