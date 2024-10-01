<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait MorphWithUser
{
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'personable');
    }
}
