<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use App\Rules\EmailFormatRule as EmailFormatRule;
use App\Rules\MinimumStringLength as MinimumStringLength;
use App\Rules\MaximumStringLength as MaximumStringLength;
use App\Rules\AllowedCharsRule as AllowedCharsRule;

class BearerTokenRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function authorize(): bool {

        return true;

    }

    public function rules(): array {

        return [
            'email' => ['required', 'bail', new EmailFormatRule(), 'bail', ],
            'auth_token' => ['required', 'bail', new MinimumStringLength(config('auth.auth_token_size')), 'bail', new MaximumStringLength(config('auth.auth_token_size')), 'bail', new AllowedCharsRule(config('auth.chars_allowed_tokens')), 'bail',],
        ];

    }

    public function messages(): array {

        return [
            'email.required' => 'Enter your email address.',
            'auth_token.required' => 'Enter your authentication token.',
        ];

    }

}
