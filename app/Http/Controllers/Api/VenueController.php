<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);

        $query = Venue::with([
            'city:id,city,province',
            'images:id,venue_id,image',
            'court' => function ($q) {
                $q->select(
                    'id',
                    'venue_id',
                    'sport_type_id',
                    'name',
                    'price',
                    'image'
                )
                ->with([
                    'sportType:id,type'
                ]);
            }
        ])
        ->withCount('court')
        ->withMin('court', 'price');

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('sport_type_id')) {
            $query->whereHas('court', function ($q) use ($request) {
                $q->where('sport_type_id', $request->sport_type_id);
            });
        }

        return response()->json($query->paginate($perPage));
    }

    public function show(Venue $venue)
    {
        $venue->load([
            'city:id,city,province',
            'images:id,venue_id,image',
            'court.sportType:id,type'
        ]);

        return response()->json($venue);
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user('venue')
        ]);
    }


}

