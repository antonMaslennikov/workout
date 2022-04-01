<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Activities extends Controller
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
        return Activitie::orderBy('sort')->get();
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

        $a = Activitie::create([
            'name' => $request->name,
            'description' => $request->description,
            'body_part' => (int) $request->body_part,
            'sort' => Activitie::getMaxSort() + 1,
        ]);

        return [
            'status' => 'ok',
            'a' => $a,
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

        $a = Activitie::find($id);

        $a->name = $request->name;
        $a->description = $request->description;
        $a->body_part = (int)$request->body_part;
        $a->save();

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
        $a = Activitie::find($id);
        $a->delete();
    }

    public function savesort(Request $request)
    {
        if ($request->order) {
            foreach ($request->order as $sort => $id) {
                if ($a = Activitie::find($id)) {
                    $a->sort = $sort;
                    $a->save();
                }
            }
        }

        return [
            'status' => 'ok',
        ];
    }
}
