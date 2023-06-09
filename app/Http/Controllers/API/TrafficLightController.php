<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\TrafficLight as TrafficLight;
use App\Models\TrafficLightHistoryItem as TrafficLightHistoryItem;
use App\Models\BearerToken as BearerToken;
use App\Traits\ResponseTrait as ResponseTrait;
use App\Http\Requests\TrafficLightRequest as TrafficLightRequest;
use \DateTime as DateTime;
use \Exception as Exception;

class TrafficLightController extends Controller {

    use ResponseTrait;

    public function store(TrafficLightRequest $request): JsonResponse {

        try {

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
            $trafficLightHistoryItem->red_light_start = new DateTime($request->red_light_start);
            $trafficLightHistoryItem->red_light_duration_in_seconds = $request->red_light_duration_in_seconds;
            $trafficLightHistoryItem->yellow_light_duration_in_seconds = $request->yellow_light_duration_in_seconds;
            $trafficLightHistoryItem->green_light_duration_in_seconds = $request->green_light_duration_in_seconds;
            $trafficLightHistoryItem->traffic_light = $trafficLight->id;
            $trafficLightHistoryItem->user = $user->id;
            $trafficLightHistoryItem->name = $request->name;
            $trafficLightHistoryItem->save();
    
            return $this->responseInJson(200, 'Traffic light successfully mapped.', null);

        } catch (Exception $e) {
            
            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

}
