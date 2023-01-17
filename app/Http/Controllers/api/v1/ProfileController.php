<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        return response()->json(auth()->user());
    }

    public function store(Request $request) {

        if (in_array($request->key, auth()->user()->getFillable())) {
            switch ($request->key) {
                case 'name':
                    auth()->user()->{$request->key} = trim($request->value);
                    auth()->user()->save();
                    break;
            }

            return response()->json(['status' => 'ok']);
        }
    }
}
