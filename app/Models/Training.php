<?php

namespace App\Models;

use App\Models\training\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function sets()
    {
        return $this->hasMany(Set::class);
    }


    public function day()
    {
        return $this->hasOne(Day::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
