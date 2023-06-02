<?php

namespace App\Traits;

trait TokenTrait {

    public function generateToken(int $size): string {
        
        $token = '';

        for ($counter = 0; $counter < $size; $counter++) {

            $token .= config('auth.chars_allowed_tokens')[rand(0, count(config('auth.chars_allowed_tokens')) - 1)];

        }

        return $token;

    }

}
