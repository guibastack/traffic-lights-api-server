<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsTo;
use App\Models\TrafficLight as TrafficLight;

class TrafficLightHistoryItem extends Model {

    protected $table = 'traffic_lights_history';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function ownerTrafficLight(): BelongsTo {
        
        return $this->belongsTo(TrafficLight::class, 'traffic_light', 'id');

    }

}
