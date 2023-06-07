<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use App\Rules\CheckDateTimeFormat as CheckDateTimeFormat;
use App\Rules\IntegerGreaterThanOrEqual as IntegerGreaterThanOrEqual;
use App\Rules\CheckIntegerFormat as CheckIntegerFormat;
use App\Rules\DateTimeCannotGreaterThanOrEqualToRule as DateTimeCannotGreaterThanOrEqualToRule;
use \DateTime as DateTime;
use App\Rules\MinimumStringLength as MinimumStringLength;

class TrafficLightRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function authorize(): bool {

        return true;

    }

    public function rules(): array {

        return [
            'latitude' => ['required', 'bail', ],
            'longitude' => ['required', 'bail', ],
            'name' => ['required', 'bail', new MinimumStringLength(4), 'bail',], 
            'red_light_start' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeCannotGreaterThanOrEqualToRule(new DateTime('now')), 'bail', ],
            'red_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormat(), 'bail', new IntegerGreaterThanOrEqual(8), 'bail',],
            'yellow_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormat(), 'bail', new IntegerGreaterThanOrEqual(1), 'bail',],
            'green_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormat(), 'bail', new IntegerGreaterThanOrEqual(20), 'bail',],
        ];

    }

    public function messages(): array {

        return [
            'latitude.required' => 'Latitude is required.',
            'longitude.required' => 'Longitude is required.',
            'name.required' => 'Enter the traffic light name.',
            'red_light_start.required' => "The red_light_start was not found.",
            'red_light_duration_in_seconds.required' => 'The red_light_duration_in_seconds was not found.',
            'yellow_light_duration_in_seconds.required' => 'The yellow_light_duration_in_seconds was not found.',
            'green_light_duration_in_seconds.required' => 'The green_light_duration_in_seconds was not found.',
        ];

    }

}
