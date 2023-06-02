<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use \Closure as Closure;
use App\Traits\RegExTrait as RegExTrait;

class EmailFormatRule implements ValidationRule {

    use RegExTrait;

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        preg_match_all($this->getEmailAddressRegex(), $value, $matches);
        $matches = $matches[0];

        if (count($matches) <= 0) {

            $fail('Enter a valid email address.');

        }

    }

}
