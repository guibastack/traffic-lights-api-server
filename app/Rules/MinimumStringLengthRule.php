<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;

class MinimumStringLengthRule implements ValidationRule {

    private int $minimumSize;

    public function __construct(int $minimumSize) {

        $this->minimumSize = $minimumSize;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        if (strlen($value) < $this->minimumSize) {

            $fail("The {$attribute} must be at least {$this->minimumSize} characters long.");

        }

    }

}
