<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;

class IntegerGreaterThanOrEqualRule implements ValidationRule {

    private int $minimum;

    public function __construct(int $minimum) {

        $this->minimum = $minimum;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        if ($value < $this->minimum) {

            $fail("The value of {$attribute} must be greater than or equal to {$this->minimum}.");

        }

    }

}
