<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use App\Models\AuthToken as AuthToken;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsTo;

class BearerToken extends Model {

    protected $table = 'bearer_tokens';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function authToken(): BelongsTo {
        
        return $this->belongsTo(AuthToken::class, 'auth_token', 'id');

    }

    public function alreadyExpiredByUser(): bool {
        
        if ($this->manually_expired_by_user_at != null) {

            return true;

        }

        return false;

    }

}
