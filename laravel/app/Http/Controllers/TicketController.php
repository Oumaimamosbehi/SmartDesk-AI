<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Dashboard
     */
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get tickets
        $tickets = $query->latest()->get();

        // Statistics
        $totalTickets = Ticket::count();

        $highPriority = Ticket::where('priority', 'high')->count();

        $inProgress = Ticket::where('status', 'in_progress')->count();

        $resolved = Ticket::where('status', 'resolved')->count();

        return view('tickets.index', compact(
            'tickets',
            'totalTickets',
            'highPriority',
            'inProgress',
            'resolved'
        ));
    }


    /**
     * Create ticket page
     */
    public function create()
    {
        return view('tickets.create');
    }


    /**
     * Store new ticket
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);


        // Create ticket
        $ticket = Ticket::create($validated);


        // Send description to Python AI service
        try {

            $response = Http::post(
                'http://127.0.0.1:8001/analyze',
                [
                    'description' => $ticket->description,
                ]
            );


            if ($response->successful()) {

                $aiResult = $response->json();


                // Save AI analysis
                $ticket->update([

                    'category' =>
                        $aiResult['category'] ?? null,

                    'priority' =>
                        $aiResult['priority'] ?? 'medium',

                    'ai_solution' =>
                        $aiResult['solution'] ?? null,

                    'ai_confidence' =>
                        $aiResult['confidence'] ?? null,

                ]);
            }

        } catch (\Exception $e) {

            // AI service unavailable
            // Ticket remains saved normally.
        }


        return redirect()
            ->route('tickets.create')
            ->with(
                'success',
                'Ticket created successfully!'
            );
    }


    /**
     * Edit ticket
     */
    public function edit(Ticket $ticket)
    {
        return view(
            'tickets.edit',
            compact('ticket')
        );
    }


    /**
     * Update ticket
     */
    public function update(
        Request $request,
        Ticket $ticket
    ) {

        $validated = $request->validate([

            'category' =>
                'nullable|string|max:255',

            'priority' =>
                'required|in:low,medium,high',

            'status' =>
                'required|in:open,in_progress,resolved',

        ]);


        $ticket->update($validated);


        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Ticket updated successfully!'
            );
    }
}

