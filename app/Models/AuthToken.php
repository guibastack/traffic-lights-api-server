<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsTo;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOne;
use App\Models\BearerToken as BearerToken;

class AuthToken extends Model {

    protected $table = 'auth_tokens';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user(): BelongsTo {
        
        return $this->belongsTo(User::class, 'user', 'id');

    }

    public function bearerTokens(): HasOne {
        
        return $this->hasOne(BearerToken::class, 'auth_token', 'id');

    }

}
