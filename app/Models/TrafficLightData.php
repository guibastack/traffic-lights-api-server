<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class TrafficLightData extends Model {

    protected $table = 'traffic_lights_data';
    protected $primaryKey = 'id';
    public $timestamps = true;

}
