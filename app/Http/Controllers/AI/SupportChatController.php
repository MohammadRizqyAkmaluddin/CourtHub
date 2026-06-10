<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupportChatController extends Controller
{
    public function chat(Request $request)
{
    try {
        $request->validate([
            'message' => 'required|string'
        ]);

        $systemContext = "
        You are Courtside AI Support Assistant for VENUE OWNERS.

        You must ONLY answer based on Courtside platform UI and workflow below.

        ====================
        COURTSIDE PLATFORM FLOW
        ====================

        1. To add a court:
        - Go to 'Court Management' menu
        - Click 'Add New Court' button
        - Fill in court details:
        - Court name
        - Sport type
        - Price per hour
        - Availability schedule
        - Upload court images (minimum 1 photo required)
        - Click 'Save' to publish court

        2. Withdraw process:
        - Withdraw requests are manually reviewed by Courtside admin
        - Status 'Pending' means waiting verification
        - Approved withdrawals will be transferred manually

        3. Profile changes:
        - Venue name and details can be edited from Settings > Venue Profile
        - Password changes from Account Settings

        RULES:
        - Always mention exact menu navigation (Dashboard > Menu > Button)
        - Never invent features that do not exist
        - If user is unclear, guide step-by-step
        - Keep answers structured and easy to follow
        ";

        $prompt = $systemContext . "\n\nUser: " . $request->message;

        $response = Http::withoutVerifying()->post(
    'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key='
    . env('GEMINI_API_KEY'),
    [
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ]
);

        // 🔥 DEBUG RESPONSE RAW DULU
        if (!$response->successful()) {
            return response()->json([
                'error' => true,
                'status' => $response->status(),
                'body' => $response->body()
            ], 500);
        }

        $data = $response->json();

        // 🔥 SAFE CHECK biar gak crash
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid Gemini response structure',
                'raw' => $data
            ], 500);
        }

        return response()->json([
            'reply' => $text
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500);
    }
}
}