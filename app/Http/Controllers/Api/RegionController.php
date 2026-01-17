<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index() {
        return response()->json(
            City::all()
        );
    }
}
