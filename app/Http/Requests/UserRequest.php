<?php

namespace App\Http\Requests;

use App\Enums\ProvidesEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'provider'     => ['nullable', 'in:'.implode(',', array_keys(ProvidesEnum::getConstants()))],
            'statusCode'   => ['nullable', 'in:'.implode(',', array_values(StatusEnum::getConstants()))],
            'currency'     => ['nullable', 'string', 'regex:/^[A-Z]{3}$/'],
            'balanceMin'   => ['nullable'],
            'balanceMax'   => ['nullable']
        ];
    }
}
