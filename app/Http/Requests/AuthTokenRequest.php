<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use App\Rules\EmailFormatRule as EmailFormatRule;

class AuthTokenRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function authorize(): bool {

        return true;

    }

    public function rules(): array {

        return [
            'email' => ['required', 'bail', new EmailFormatRule(), 'bail',],
        ];

    }

    public function messages(): array {

        return [
            'email.required' => 'Enter your email address.',
        ];

    }

}
