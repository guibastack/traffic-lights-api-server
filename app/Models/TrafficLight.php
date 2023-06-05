<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class TrafficLight extends Model {

    protected $table = 'traffic_lights';
    protected $primaryKey = 'id';
    public $timestamps = true;

}
