<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasMany;
use App\Models\TrafficLightHistoryItem as TrafficLightHistoryItem;

class TrafficLight extends Model {

    protected $table = 'traffic_lights';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function history(): HasMany {
        
        return $this->hasMany(TrafficLightHistoryItem::class, 'traffic_light', 'id');

    }

}
