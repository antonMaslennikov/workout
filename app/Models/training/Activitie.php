<?php

namespace App\Models\training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

//    public $results = [];

    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'trainings__activities';

    protected $fillable = ['set_id', 'activitie_id', 'quantity', 'comment', 'complited',];

    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    public function activitie()
    {
        return $this->belongsTo(\App\Models\Activitie::class);
    }

    public function results($day_id = null)
    {
        $q = $this->hasMany(Result::class, 'training_activitie_id');

        if ($day_id) {
            $q->where('days_id', '=', $day_id);
        }

        return $q->get();
    }
}
