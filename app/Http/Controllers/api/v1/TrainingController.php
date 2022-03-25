<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($y, $m, $d)
    {
        $trainings = Training::whereBetween('start_at', ["$y-$m-$d 00:00:00", "$y-$m-$d 23:59:59"])
            ->orderBy('start_at')
            ->get();

//        foreach ($trainings AS $k => $t) {
//            if (!$t->name) {
//                $t->name = 'Тренировка #' . $k;
//            }
//        }

        return $trainings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'year' => ['required', 'integer', 'between:' . date('Y') . ',' . (date('Y') + 10)],
                'month' => ['required', 'integer', 'between:0,12'],
                'day' => ['required', 'integer', 'between:1,31'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $d = new \DateTimeImmutable($request->year . '-' . $request->month . '-' . $request->day . ' ' . ($request->hour ?? '00') . ':' . ($request->minute ?? '00') . ':00');

        $t = Training::create([
            'name' => $request->name,
            'start_at' => $d->format('Y-m-d H:i:00'),
            'end_at' => null,
        ]);

        return [
            'status' => 'ok',
            't' => $t,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
