<?php

namespace App\Models\training;

use App\Models\Day;
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

    protected $fillable = ['training_activitie_id', 'days_id', 'repeats', 'weight'];

    public function trainingActivitie()
    {
        return $this->belongsTo(Activitie::class, 'training_activitie_id');
    }

    public function training()
    {
        return $this->belongsTo(Day::class, 'days_id');
    }
}
