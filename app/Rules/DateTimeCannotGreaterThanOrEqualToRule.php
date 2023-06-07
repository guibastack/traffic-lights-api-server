<?php

namespace App\Rules;

use \Closure as Closure;
use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \DateTime as DateTime;

class DateTimeCannotGreaterThanOrEqualToRule implements ValidationRule {

    private DateTime $deadlineTime;

    public function __construct(DateTime $deadlineTime) {

        $this->deadlineTime = $deadlineTime;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        if (new DateTime($value) >= $this->deadlineTime) {
            
            $fail("The {$attribute} cannot be greater than or equal to {$this->deadlineTime->format('Y-m-d H:i:s')}.");

        }

    }

}
