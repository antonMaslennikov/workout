<?php

namespace App\Models\training;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'trainings__results';

    protected $fillable = ['training_activitie_id', 'repeats', 'weight'];

    public function trainingActivitie()
    {
        return $this->belongsTo(Activitie::class);
    }
}
