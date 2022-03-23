<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sort'];

    public static function getMaxSort() {
        $last = Activitie::select('sort')
            ->orderByDesc('sort')
            ->limit(1)
            ->first();

        return $last->sort;
    }
}
