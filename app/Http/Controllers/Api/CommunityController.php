<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $query = Community::with('sportType','city','venue','venue.city','user','member');

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('sport_type_id')) {
            $query->where('sport_type_id', $request->sport_type_id);
        }

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request) {
        // $request->validate([
        //     'user_id'  => 'required|users:user_id',
        //     'venue_id' => 'nullable|venues:id',
        //     'sport_type_id' => 'required|sport_types:id',
        //     'name' => 'required|string',
        //     'city_id' => 'nullable|cities:id',
        //     'address' => 'nullable|string',
        //     'latitude' => 'nullable|string',
        //     'longitude' => 'nullable|string',
        //     'membership_fee' => 'required|integer',
        //     'total_member' => 'required|integer',
        //     'max_slot' => 'required|integer',
        //     'description'   => 'required|string',
        //     'image' => 'nullable|image',
        //     'day_of_week' => 'required|integer',
        //     // 'start_time' => 'required',
        //     // 'end_time' => 'required'
        // ]);

        $venueCheck = Community::where('venue_id', $request->venue_id)->first();

        if ($venueCheck) {
            return response()->json([
                'success' => false,
                'message' => 'venue already has community'
            ]);
        }

        $data = Community::create([
            'user_id'   => $request->user_id,
            'venue_id'  => $request->venue_id,
            'sport_type_id' => $request->sport_type_id,
            'name'  => $request->name,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'membership_fee' => $request->membership_fee,
            'total_member' => $request->total_member,
            'max_slot' => $request->max_slot,
            'description' => $request->description,
            'image' => $request->image,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return response()->json([
            'success' => true,
            'community' => $data
        ]);
    }
}
