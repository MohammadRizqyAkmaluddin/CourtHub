<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueController extends Controller
{
    // PUBLIC
    public function index(Request $request)
    {
        $query = Venue::with('region:id,city');

        if ($request->region_id) {
            $query->where('region_id', $request->region_id);
        }

        return response()->json(
            $query->select('id','name','region_id','logo')->get()
        );
    }

    // AUTH: VENUE
    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user('venue')
        ]);
    }


}

