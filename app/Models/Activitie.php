<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'body_part', 'sort'];

    public static function getMaxSort() {
        $last = self::select('sort')
            ->orderByDesc('sort')
            ->limit(1)
            ->first();

        return $last->sort;
    }
}
