<?php

namespace App\Http\Controllers\api\v1\trainings;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\training\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivitiesController extends Controller
{
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
        $validator = Validator::make(
            $request->all(),
            [
                'set_id' => ['required', 'integer'],
                'activitie_id' => ['required', 'integer'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $a = Activitie::create([
            'set_id' => $request->set_id,
            'activitie_id' => $request->activitie_id,
            'quantity' => $request->quantity ?? 1,
            'comment' => $request->comment,
        ]);

        // чтобы извлечь данные об упраженении в модель
        $a->activitie;

        return [
            'status' => 'ok',
            'a' => $a,
        ];
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
        $validator = Validator::make(
            $request->all(),
            [
                'set_id' => ['required', 'integer'],
                'activitie_id' => ['required', 'integer'],
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 'errors',
                'messages' => $validator->messages()
            ];
        }

        $a = Activitie::find($id);

        if ($a->set->training->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        $a->activitie_id = $request->activitie_id;
        $a->quantity = trim($request->quantity);
        $a->comment = $request->comment;
        $a->save();

        $a->activitie->name;

        return [
            'status' => 'ok',
            'a' => $a,
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
        $a = Activitie::findOrFail($id);

        if ($a->set->training->user_id == auth()->user()->id) {
            $a->delete();
            return ['status' => 'ok'];
        } else {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
    }
}
