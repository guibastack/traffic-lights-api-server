<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;

class AllowedCharsRule implements ValidationRule {

    private array $allowedChars;

    public function __construct(array $allowedChars) {

        $this->allowedChars = $allowedChars;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        $value = str_split($value, 1);

        foreach ($value as $letter) {

            if (!in_array($letter, $this->allowedChars)) {

                $fail("The {$attribute} cannot have the {$letter} character.");
                return;

            }

        }

    }

}
