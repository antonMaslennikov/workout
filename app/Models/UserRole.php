<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
//    protected $touches = ['User'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
