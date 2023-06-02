<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse as JsonResponse;

trait ResponseTrait {

    public function responseInJSON(int $httpStatusCode, ?string $message, ?array $responseData): JsonResponse {

        return response()->json([
            'message' => $message == null ? '' : $message,
            'data' => $responseData == null ? [] : $responseData,
        ], $httpStatusCode);

    }

}
