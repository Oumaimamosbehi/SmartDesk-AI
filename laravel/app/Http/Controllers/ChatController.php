<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array',
        ]);

        try {

            $response = Http::post(
                'http://127.0.0.1:8001/chat',
                [
                    'message' => $validated['message'],

                    'history' =>
                        $validated['history'] ?? [],
                ]
            );

            if ($response->successful()) {

                return response()->json(
                    $response->json()
                );
            }

            return response()->json([
                'error' => 'AI service returned an error.'
            ], 500);

        } catch (\Exception $e) {

            return response()->json([
                'error' =>
                    'Unable to connect to SmartDesk AI.'
            ], 500);
        }
    }
}