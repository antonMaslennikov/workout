<?php

namespace App\Models\training;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'trainings__sets';

    protected $fillable = ['training_id', 'sort'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function activities()
    {
        return $this->hasMany(Activitie::class);
    }
}
