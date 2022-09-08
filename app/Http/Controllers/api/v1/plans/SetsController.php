<?php

namespace App\Http\Controllers\api\v1\plans;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\training\Set;
use Illuminate\Http\Request;

class SetsController extends Controller
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
        $Set = new Set();
        $Set->training_id = (int) $request->training_id;
        $Set->quantity = (int) $request->quantity;
        $Set->comment = (int) $request->comment;
        $Set->save();

        return [
            'status' => 'ok',
            'set' => $Set,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Set = Set::query()->where(['id' => $id])->firstOrFail();

        if ($Set->training->user_id == auth()->user()->id) {
            $Set->quantity = (int)$request->quantity;
            $Set->comment = trim($request->comment);
            $Set->save();

            foreach ($Set->activities AS &$a) {
                $a->activitie;
            }
        }

        return [
            'status' => 'ok',
            'set' => $Set,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $set = Set::find($id);

        if ($set->training->user_id == auth()->user()->id) {
            $set->delete();
            return ['status' => 'ok'];
        } else {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
    }
}
