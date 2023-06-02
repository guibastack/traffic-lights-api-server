<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;

class MaximumStringLength implements ValidationRule {

    private int $maximumSize;

    public function __construct(int $maximumSize) {

        $this->maximumSize = $maximumSize;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        if (strlen($value) > $this->maximumSize) {

            $fail("The {$attribute} must be a maximum of {$this->maximumSize} characters.");

        }

    }

}
