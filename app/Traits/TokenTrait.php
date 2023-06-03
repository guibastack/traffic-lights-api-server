<?php

namespace App\Traits;

use \DateTime as DateTime;

trait TokenTrait {

    public function generateToken(int $size): string {
        
        $token = '';

        for ($counter = 0; $counter < $size; $counter++) {

            $token .= config('auth.chars_allowed_tokens')[rand(0, count(config('auth.chars_allowed_tokens')) - 1)];

        }

        return $token;

    }

    public function calculateTokenExpiryTime(DateTime $tokenGenerationDateTime, int $tokenExpirationInSeconds): DateTime {
        
        return new DateTime(date('Y-m-d H:i:s', ($tokenGenerationDateTime->getTimestamp() + $tokenExpirationInSeconds)));

    }

    public function tokenIsExpired(DateTime $tokenExpirationDateTime): bool {
        
        if ($tokenExpirationDateTime >= new DateTime('now')) {

            return false;

        }

        return true;

    }

}
