<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsTo;
use App\Models\User as User;

class Profile extends Model {

    protected $table = 'profiles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user(): BelongsTo {
        
        return $this->belongsTo(User::class, 'user', 'id');

    }

}
