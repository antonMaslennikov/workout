<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivitieFormRequest;
use App\Models\Activitie;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activitie::orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.activities.index', [
            'activities' => $activities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activities.create', [
            'body_parts' => Activitie::$body_parts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivitieFormRequest $request)
    {
        $data = $request->validated();

        $post = Activitie::create($data);
        return redirect(route('admin.activities.index'));
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
        $a = Activitie::findOrFail($id);

        return view('admin.activities.create', [
            'a' => $a,
            'body_parts' => Activitie::$body_parts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivitieFormRequest $request, $id)
    {
        $post = Activitie::findOrFail($id);

        $data = $request->validated();

        $post->update($data);

        return redirect(route('admin.activities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activitie::destroy($id);
        return redirect(route('admin.activities.index'));
    }
}
