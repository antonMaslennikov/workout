<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        return response()->json(auth()->user());
    }
}
