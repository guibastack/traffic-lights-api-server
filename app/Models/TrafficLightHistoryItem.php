<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class TrafficLightHistoryItem extends Model {

    protected $table = 'traffic_lights_history';
    protected $primaryKey = 'id';
    public $timestamps = true;

}
