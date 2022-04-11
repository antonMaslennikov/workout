<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'body_part', 'sort'];

    public static $body_parts = [
        ['id' => 1, 'name' => 'Руки'],
        ['id' => 2, 'name' => 'Ноги'],
        ['id' => 3, 'name' => 'Спина'],
        ['id' => 4, 'name' => 'Грудь'],
        ['id' => 5, 'name' => 'Плечи'],
        ['id' => 6, 'name' => 'Живот'],
    ];

    public static function getMaxSort() {
        $last = self::select('sort')
            ->orderByDesc('sort')
            ->limit(1)
            ->first();

        if ($last) {
            return $last->sort;
        } else {
            return 0;
        }
    }
}
