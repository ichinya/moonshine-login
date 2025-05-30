<?php

namespace Ichinya\MoonshineLogin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore(auth()->id())],
            'password' => ['confirmed'],
        ];
    }
}
