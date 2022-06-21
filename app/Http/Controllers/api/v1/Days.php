<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Days extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $y integer Год
     * @param $m integer Месяц
     * @return \Illuminate\Http\Response
     */
    public function index($y = null, $m = null)
    {
//        $trainings = DB::table('trainings')
//            ->whereBetween('start_at', ["$y-$m-01 00:00:00", "$y-$m-31 23:59:59"])
//            ->where(['user_id' => auth()->user()->id])
//            ->get();
        $trainings = DB::table('days')
            ->join('trainings', 'trainings.id', '=',  'days.training_id')
            ->whereBetween('start_at', ["$y-$m-01 00:00:00", "$y-$m-31 23:59:59"])
            ->where(['trainings.user_id' => auth()->user()->id])
            ->select('days.*')
            ->get();

        $data = [];

        foreach ($trainings AS $t) {
            $d = new \DateTimeImmutable($t->start_at);
            if (!isset($data[$d->format('j')])) {
                $data[$d->format('j')] = ['trainings' => 0];
            }
            $data[$d->format('j')]['trainings']++;
        }

        return $data;
    }
}
