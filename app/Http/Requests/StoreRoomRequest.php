<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomRequest extends FormRequest
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
            'number'            => 'required|integer|unique:rooms,number',
            'type'              => ['required', 'string', Rule::in(['single', 'double', 'triple', 'family', 'studio'])],
            'price_per_night'   => 'required|numeric',
            'status'            => ['required', 'string', Rule::in(['available', 'reserved'])]
        ];
    }
}
