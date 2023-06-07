<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use App\Rules\CheckDateTimeFormatRule as CheckDateTimeFormatRule;
use App\Rules\IntegerGreaterThanOrEqualRule as IntegerGreaterThanOrEqualRule;
use App\Rules\CheckIntegerFormatRule as CheckIntegerFormatRule;
use App\Rules\DateTimeCannotGreaterThanOrEqualToRule as DateTimeCannotGreaterThanOrEqualToRule;
use \DateTime as DateTime;
use App\Rules\MinimumStringLengthRule as MinimumStringLengthRule;

class TrafficLightRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function authorize(): bool {

        return true;

    }

    public function rules(): array {

        return [
            'latitude' => ['required', 'bail', ],
            'longitude' => ['required', 'bail', ],
            'name' => ['required', 'bail', new MinimumStringLengthRule(4), 'bail',], 
            'red_light_start' => ['required', 'bail', new CheckDateTimeFormatRule(), 'bail', new DateTimeCannotGreaterThanOrEqualToRule(new DateTime('now')), 'bail', ],
            'red_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormatRule(), 'bail', new IntegerGreaterThanOrEqualRule(8), 'bail',],
            'yellow_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormatRule(), 'bail', new IntegerGreaterThanOrEqualRule(1), 'bail',],
            'green_light_duration_in_seconds' => ['required', 'bail', new CheckIntegerFormatRule(), 'bail', new IntegerGreaterThanOrEqualRule(20), 'bail',],
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
