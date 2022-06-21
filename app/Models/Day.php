<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'training_id', 'start_at', 'end_at'];


    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
