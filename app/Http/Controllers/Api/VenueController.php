<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

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
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $venue = $request->user();

        $venue->update(
            $request->only('name','address','logo','cover')
        );

        return response()->json([
            'message' => 'Profile updated',
            'venue'   => $venue,
        ]);
    }
}

