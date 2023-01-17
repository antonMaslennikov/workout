<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivitieFormRequest;
use App\Models\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivitiesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Activitie::class, 'activity');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Activitie::orderBy('created_at', 'DESC');

        


        $activities = $query->paginate(10);

        return view('admin.activities.index', [
            'activities' => $activities,
            'body_parts' => Activitie::$body_parts,
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
     * Show the form for editing the specified resource.
     *
     * @param  Activitie  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activitie $activity)
    {
        if (!Gate::allows('update-activitie', $activity)) {
            abort(403);
        }
        // анналогично предыдущему
//        if (!auth('admin')->user()->can('update-activitie', $a)) {
//        abort(403);
//        }

        return view('admin.activities.create', [
            'a' => $activity,
            'body_parts' => Activitie::$body_parts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Activitie  $a
     * @return \Illuminate\Http\Response
     */
    public function update(ActivitieFormRequest $request, Activitie $activity)
    {
        $data = $request->validated();

        $activity->update($data);

        return redirect(route('admin.activities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activitie $activity)
    {
        $this->authorize('delete-activitie');

        $activity->delete();

        return redirect(route('admin.activities.index'));
    }
}
