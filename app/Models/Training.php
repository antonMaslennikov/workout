<?php

namespace App\Models;

use App\Models\training\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_at', 'end_at', 'complited'];

    public function sets()
    {
        return $this->hasMany(Set::class);
    }
}
