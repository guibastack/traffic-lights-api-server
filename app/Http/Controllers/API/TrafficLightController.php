<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\TrafficLight as TrafficLight;
use App\Models\TrafficLightHistoryItem as TrafficLightHistoryItem;
use App\Models\BearerToken as BearerToken;
use App\Traits\ResponseTrait as ResponseTrait;

class TrafficLightController extends Controller {

    use ResponseTrait;

    public function store(Request $request): JsonResponse {
        
        $trafficLight = TrafficLight::where('latitude', '=', $request->latitude)
                                    ->where('longitude', '=', $request->longitude)
                                    ->first();

        if ($trafficLight == null) {

            $trafficLight = new TrafficLight();
            $trafficLight->latitude = $request->latitude;
            $trafficLight->longitude = $request->longitude;
            $trafficLight->save();

        }

        $user = (BearerToken::where('bearer_token', '=', $request->bearerToken())
                            ->first())->authToken->ownerUser;

        $trafficLightHistoryItem = new TrafficLightHistoryItem();
        $trafficLightHistoryItem->red_light_start = date('Y-m-d H:i:s', $request->red_light_start);
        $trafficLightHistoryItem->red_light_duration_in_seconds = $request->red_light_end - $request->red_light_start;
        $trafficLightHistoryItem->red_light_end = date('Y-m-d H:i:s', $request->red_light_end);
        $trafficLightHistoryItem->yellow_light_start = date('Y-m-d H:i:s', $request->yellow_light_start);
        $trafficLightHistoryItem->yellow_light_duration_in_seconds = $request->yellow_light_end - $request->yellow_light_start;
        $trafficLightHistoryItem->yellow_light_end = date('Y-m-d H:i:s', $request->yellow_light_end);
        $trafficLightHistoryItem->green_light_start = date('Y-m-d H:i:s', $request->green_light_start);
        $trafficLightHistoryItem->green_light_duration_in_seconds = $request->green_light_end - $request->green_light_start;
        $trafficLightHistoryItem->green_light_end = date('Y-m-d H:i:s', $request->green_light_end);
        $trafficLightHistoryItem->traffic_light = $trafficLight->id;
        $trafficLightHistoryItem->user = $user->id;
        $trafficLightHistoryItem->name = $request->name;
        $trafficLightHistoryItem->save();

        return $this->responseInJson(200, 'Traffic light successfully mapped.', null);

    }

}
