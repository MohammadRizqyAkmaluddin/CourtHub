<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SportType;
use App\Models\City;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function sportType()
    {
        return response()->json(
            SportType::all()
        );
    }

    public function city()
    {
        return response()->json(
            City::all()
        );
    }
}
