<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use App\Rules\CheckDateTimeFormat as CheckDateTimeFormat;
use App\Rules\DateTimeGreaterThanDateTime as DateTimeGreaterThanDateTime;

class TrafficLightRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function authorize(): bool {

        return true;

    }

    public function rules(): array {

        return [
            'latitude' => ['required', 'bail', ],
            'longitude' => ['required', 'bail', ],
            'name' => ['required', 'bail', ], 
            'red_light_start' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', ],
            'red_light_end' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeGreaterThanDateTime('red_light_start', $this->red_light_start), 'bail',],
            'yellow_light_start' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeGreaterThanDateTime('red_light_end', $this->red_light_end), 'bail',],
            'yellow_light_end' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeGreaterThanDateTime('yellow_light_start', $this->yellow_light_start), 'bail',],
            'green_light_start' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeGreaterThanDateTime('yellow_light_end', $this->yellow_light_end), 'bail',],
            'green_light_end' => ['required', 'bail', new CheckDateTimeFormat(), 'bail', new DateTimeGreaterThanDateTime('green_light_start', $this->green_light_start), 'bail',], 
        ];

    }

    public function messages(): array {

        return [
            'latitude.required' => 'Latitude is required.',
            'longitude.required' => 'Longitude is required.',
            'name.required' => 'Enter the traffic light name.',
            'red_light_start.required' => "The red_light_start was not found.",
            'red_light_end.required' => 'The red_light_end was not found.',
            'yellow_light_start.required' => 'The yellow_light_start was not found.',
            'yellow_light_end.required' => 'The yellow_light_end was not found.',
            'green_light_start.required' => 'The green_light_start was not found.',
            'green_light_end.required' => 'The green_light_end was not found.',
        ];

    }

}
