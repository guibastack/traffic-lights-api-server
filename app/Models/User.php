<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasMany;
use App\Models\AuthToken as AuthToken;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOne;
use App\Models\Profile as Profile;
use App\Models\TrafficLightHistoryItem as TrafficLightHistoryItem;

class User extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function authTokens(): HasMany {

        return $this->hasMany(AuthToken::class, 'user', 'id');

    }

    public function profile(): HasOne {
        
        return $this->hasOne(Profile::class, 'user', 'id');

    }

    public function trafficLightsHistoryItems(): HasMany {
        
        return $this->hasMany(TrafficLightHistoryItem::class, 'user', 'id');

    }

}
