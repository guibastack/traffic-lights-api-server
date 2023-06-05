<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;
use \DateTime as DateTime;
use \Exception as Exception;

class CheckDateTimeFormat implements ValidationRule {

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        try {
            
            new DateTime($value);

        } catch (Exception $e) {
            
            $fail("The datetime format of {$attribute} is invalid.");

        }

    }

}
