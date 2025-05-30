<?php

namespace Ichinya\MoonshineLogin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:dns', Rule::unique('users')],
            'password' => ['required', 'confirmed'],
        ];
    }
}
