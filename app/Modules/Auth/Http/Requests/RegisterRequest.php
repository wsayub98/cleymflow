<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !\Illuminate\Support\Facades\Auth::check();
        /* return true; */
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:5120',
            ]
        ];
    }

    /* #[Override] */
    /* protected function failedValidation(Validator $validator) */
    /* { */
    /*     return parent::failedValidation($validator); */
    /* } */
}
