<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;
use \DateTime as DateTime;

class DateTimeGreaterThanDateTime implements ValidationRule {

    private string $targetAttribute;
    private DateTime $targetValue;

    public function __construct(string $targetAttribute, string $targetValue) {

        $this->targetAttribute = $targetAttribute;
        $this->targetValue = new DateTime($targetValue);

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        $value = new DateTime($value);

        if ($value <= $this->targetValue) {

            $fail("The {$attribute} must be greater than {$this->targetAttribute}.");

        }

    }

}
