<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsTo;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOne;
use App\Models\BearerToken as BearerToken;
use \DateTime as DateTime;

class AuthToken extends Model {

    protected $table = 'auth_tokens';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function ownerUser(): BelongsTo {
        
        return $this->belongsTo(User::class, 'user', 'id');

    }

    public function bearerToken(): HasOne {
        
        return $this->hasOne(BearerToken::class, 'auth_token', 'id');

    }

    public function isExpired() {

        if (new DateTime($this->expires_at) >= new DateTime('now')) {

            return false;

        }

        return true;

    }

}
