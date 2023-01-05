<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Training;
use App\Models\training\Activitie;
use App\Models\training\Result;
use App\Models\training\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($y, $m, $d)
    {
        $trainings = Day::with('training.sets.activities.activitie')
            ->join('trainings', 'trainings.id', '=', 'days.training_id')
            ->where(['trainings.user_id' => auth()->user()->id])
            ->orderBy('days.start_at')
            ->whereBetween('days.start_at', ["$y-$m-$d 00:00:00", "$y-$m-$d 23:59:59"])
            ->select(['days.*', 'trainings.name', 'trainings.user_id'])
            ->get();

        foreach ($trainings AS $k => $t) {
            $d = new \DateTimeImmutable($t->start_at);
            $t->hour = $d->format('H');
            $t->minute = $d->format('i');
        }

        //dd($trainings);

        return $trainings;
    }

    public function my()
    {
        $trainings = Training::with('sets.activities.activitie')
            ->where(['user_id' => auth()->user()->id])
            ->paginate(50);

        //dd($trainings);

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
                'training_id' => ['required', 'integer'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $day = new \DateTimeImmutable($request->year . '-' . $request->month . '-' . $request->day . ' ' . ($request->hour ?? '00') . ':' . ($request->minute ?? '00') . ':00');

        $d = Day::create([
            'training_id' => $request->training_id,
            'date' => $day->format('Y-m-d'),
            'start_at' => $day->format('Y-m-d H:i:00'),
            'end_at' => null,
        ]);

        $d = Day::query()
                ->where('id', $d->id)
                ->with('training.sets.activities.activitie')
                ->first();

        return [
            'status' => 'ok',
            't' => $d,
        ];
    }

    /**
     * Страница выполнения тренировки
     *
     * @param  \App\Models\Day $training
     * @return \Illuminate\Http\Response
     */
    public function show(Day $training)
    {
//        $results = Result::query()->where(['days_id' => $training->id])->get();

        foreach ($training->training->sets as $s) {
            foreach ($s->activities as $a) {
                $a->activitie;

                $a->results = $a->results($training->id);

//                foreach ($results AS $r) {
//                    if ($a->id == $r->training_activitie_id) {
//                        $a->results[] = $r;
//                    }
//                }
            }
        };

        return [
            'status' => 'ok',
            't' => $training,
        ];
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
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'year' => ['required', 'integer', 'between:' . date('Y') . ',' . (date('Y') + 10)],
                'month' => ['required', 'integer', 'between:0,12'],
                'day' => ['required', 'integer', 'between:1,31'],
//                'hour' => ['integer', 'between:0,24'],
//                'minute' => ['integer', 'between:0,60'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $d = new \DateTimeImmutable($request->year . '-' . $request->month . '-' . $request->day . ' ' . ($request->hour ?? '00') . ':' . ($request->minute ?? '00') . ':00');

        $D = Day::query()->where(['id' => $id])->firstOrFail();
        $D->start_at = $d->format('Y-m-d H:i:00');
        $D->save();

        $D->training->name = $request->name;
        $D->training->save();

        return [
            'status' => 'ok',
            'a' => $D,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t = Day::find($id);
        $t->delete();
    }
}
