<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasMany;
use App\Models\AuthToken as AuthToken;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOne;
use App\Models\Profile as Profile;

class User extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function authTokens(): hasMany {

        return $this->hasMany(AuthToken::class, 'user', 'id');

    }

    public function profile(): HasOne {
        
        return $this->hasOne(Profile::class, 'user', 'id');

    }

}
