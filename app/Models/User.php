<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasMany;
use App\Models\AuthToken as AuthToken;

class User extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function authTokens(): hasMany {

        return $this->hasMany(AuthToken::class, 'user', 'id');

    }

}
