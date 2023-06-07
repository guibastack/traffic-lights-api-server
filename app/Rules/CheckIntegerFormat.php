<?php

namespace App\Rules;

use \Closure as Closure;
use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;

class CheckIntegerFormat implements ValidationRule {

    public function __construct() {}

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        if (!is_int($value)) {
            
            $fail("The {$attribute} must be of type integer.");

        }

    }

}
