<?php

namespace App\Traits;

use \DateTime as DateTime;
use Illuminate\Database\Eloquent\Model as Model;

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

    public function tokenIsUnique(Model $model, string $column, string $token, ?array $dataSet): bool {

        $query = $model->where($column, '=', $token);

        if ($dataSet != null) {

            foreach ($dataSet as $key => $value) {
                
                $query->where($key, '=', $value);
                
            }

        }

        if (count($query->get()) > 0) {

            return false;

        }

        return true;

    }

}
