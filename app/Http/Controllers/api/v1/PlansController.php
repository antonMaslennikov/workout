<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Training;
use App\Models\training\Activitie;
use App\Models\training\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                'name' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $t = Training::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        $t->sets;

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
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $T = Training::query()->where(['id' => $id])->firstOrFail();
        $T->name = $request->name;
        $T->save();

        return [
            'status' => 'ok',
            't' => $T,
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
        $t = Training::query()
            ->where('id', $id)
            ->where('user_id', auth()->user()->id);

        $t->delete();
    }
}
