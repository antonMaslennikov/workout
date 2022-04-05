<?php

namespace App\Models;

use App\Models\training\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_at', 'end_at', 'complited', 'user_id'];

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
