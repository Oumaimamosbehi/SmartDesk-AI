
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartDesk AI - Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            width: 92%;
            max-width: 1200px;
            margin: 35px auto;
        }

        /* =========================
           HEADER
        ========================== */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 30px;
            color: #111827;
        }

        .logo p {
            margin-top: 6px;
            color: #6b7280;
        }

        .new-ticket {
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .new-ticket:hover {
            background: #1d4ed8;
        }


        /* =========================
           SUCCESS MESSAGE
        ========================== */

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 25px;
        }


        /* =========================
           STATISTICS
        ========================== */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 12px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .stat-title {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
            color: #111827;
        }


        /* =========================
           SECTION TITLE
        ========================== */

        .section-title {
            margin-bottom: 18px;
        }

        .section-title h2 {
            font-size: 22px;
            color: #111827;
        }


        /* =========================
           TICKET CARD
        ========================== */

        .ticket-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .ticket-header h3 {
            font-size: 20px;
            color: #111827;
        }

        .ticket-id {
            color: #9ca3af;
            font-size: 13px;
        }


        /* =========================
           BADGES
        ========================== */

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }

        .badge {
            padding: 7px 12px;
            background: #f3f4f6;
            border-radius: 20px;
            font-size: 13px;
            color: #374151;
        }


        /* =========================
           CUSTOMER
        ========================== */

        .customer {
            background: #f9fafb;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .customer p {
            margin: 5px 0;
            font-size: 14px;
        }


        /* =========================
           DESCRIPTION
        ========================== */

        .description-title {
            font-weight: bold;
            margin-bottom: 7px;
        }

        .description {
            line-height: 1.6;
            color: #4b5563;
        }


        /* =========================
           AI SOLUTION
        ========================== */

        .ai-solution {
            margin-top: 20px;
            padding: 18px;

            background: #eff6ff;

            border-left: 5px solid #2563eb;

            border-radius: 8px;

            color: #1e3a8a;
        }

        .ai-solution strong {
            display: block;
            margin-bottom: 8px;
        }

        .ai-solution p {
            line-height: 1.6;
        }


        /* =========================
           ACTIONS
        ========================== */

        .actions {
            margin-top: 20px;
        }

        .edit-button {
            display: inline-block;

            text-decoration: none;

            background: #111827;

            color: white;

            padding: 9px 15px;

            border-radius: 7px;

            font-size: 14px;
        }

        .edit-button:hover {
            background: #374151;
        }


        /* =========================
           EMPTY
        ========================== */

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            color: #6b7280;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

        }

        .filters {
    background: white;
    padding: 18px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.filters form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filters select {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    background: white;
    min-width: 160px;
}

.filters button {
    padding: 10px 18px;
    border: none;
    border-radius: 7px;
    background: #2563eb;
    color: white;
    cursor: pointer;
}

.filters button:hover {
    background: #1d4ed8;
}

.filters a {
    padding: 10px 18px;
    border-radius: 7px;
    background: #f3f4f6;
    color: #374151;
    text-decoration: none;
}

    </style>

</head>


<body>

<div class="container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="header">

        <div class="logo">

            <h1>🤖 SmartDesk AI</h1>

            <p>
                AI-powered customer support dashboard
            </p>

        </div>


        <a
            href="{{ route('tickets.create') }}"
            class="new-ticket"
        >
            + New Ticket
        </a>

    </div>


    <!-- =========================
         SUCCESS MESSAGE
    ========================== -->

    @if (session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif



    <!-- =========================
         STATISTICS
    ========================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-title">
                Total Tickets
            </div>

            <div class="stat-number">
                {{ $totalTickets }}
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">
                High Priority
            </div>

            <div class="stat-number">
                {{ $highPriority }}
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">
                In Progress
            </div>

            <div class="stat-number">
                {{ $inProgress }}
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">
                Resolved
            </div>

            <div class="stat-number">
                {{ $resolved }}
            </div>

        </div>

    </div>

    <div class="filters">

    <form method="GET" action="{{ route('tickets.index') }}">

        <select name="category">
            <option value="">All Categories</option>

            <option value="network"
                {{ request('category') == 'network' ? 'selected' : '' }}>
                Network
            </option>

            <option value="software"
                {{ request('category') == 'software' ? 'selected' : '' }}>
                Software
            </option>

            <option value="hardware"
                {{ request('category') == 'hardware' ? 'selected' : '' }}>
                Hardware
            </option>

            <option value="account"
                {{ request('category') == 'account' ? 'selected' : '' }}>
                Account
            </option>
        </select>


        <select name="priority">

            <option value="">All Priorities</option>

            <option value="high"
                {{ request('priority') == 'high' ? 'selected' : '' }}>
                High
            </option>

            <option value="medium"
                {{ request('priority') == 'medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="low"
                {{ request('priority') == 'low' ? 'selected' : '' }}>
                Low
            </option>

        </select>


        <select name="status">

            <option value="">All Statuses</option>

            <option value="open"
                {{ request('status') == 'open' ? 'selected' : '' }}>
                Open
            </option>

            <option value="in_progress"
                {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                In Progress
            </option>

            <option value="resolved"
                {{ request('status') == 'resolved' ? 'selected' : '' }}>
                Resolved
            </option>

        </select>


        <button type="submit">
            Filter
        </button>


        <a href="{{ route('tickets.index') }}">
            Reset
        </a>

    </form>

</div>

    <!-- =========================
         TICKETS
    ========================== -->

    <div class="section-title">

        <h2>
            Support Tickets
        </h2>

    </div>



    @forelse ($tickets as $ticket)


        <div class="ticket-card">


            <!-- Ticket header -->

            <div class="ticket-header">

                <div>

                    <h3>
                        {{ $ticket->subject }}
                    </h3>

                    <span class="ticket-id">
                        Ticket #{{ $ticket->id }}
                    </span>

                </div>

            </div>



            <!-- Badges -->

            <div class="badges">


                <span class="badge">

                    Category:

                    {{ $ticket->category
                        ? ucfirst($ticket->category)
                        : 'Not analyzed'
                    }}

                </span>



                <span class="badge">

                    Priority:

                    {{ ucfirst($ticket->priority) }}

                </span>



                <span class="badge">

                    Status:

                    {{ ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $ticket->status
                        )
                    ) }}

                </span>

                <span class="badge">
                🤖 AI Confidence:
                {{ $ticket->ai_confidence !== null
                    ? round($ticket->ai_confidence * 100) . '%'
                    : 'N/A'
                }}
                </span>
            </div>



            <!-- Customer -->

            <div class="customer">

                <p>

                    <strong>Name:</strong>

                    {{ $ticket->name }}

                </p>


                <p>

                    <strong>Email:</strong>

                    {{ $ticket->email }}

                </p>

            </div>



            <!-- Description -->

            <div class="description">

                <div class="description-title">

                    Description

                </div>


                {{ $ticket->description }}

            </div>



            <!-- AI Solution -->

            @if ($ticket->ai_solution)

                <div class="ai-solution">

                    <strong>

                        🤖 AI Suggested Solution

                    </strong>


                    <p>

                        {{ $ticket->ai_solution }}

                    </p>

                </div>

            @else

                <div class="ai-solution">

                    <strong>

                        🤖 AI Suggested Solution

                    </strong>


                    <p>

                        AI analysis is not available
                        for this ticket.

                    </p>

                </div>

            @endif



            <!-- Edit -->

            <div class="actions">

                <a
                    href="{{ route('tickets.edit', $ticket) }}"
                    class="edit-button"
                >
                    Edit Ticket
                </a>

            </div>


        </div>


    @empty


        <div class="empty">

            <h2>
                No tickets yet
            </h2>

            <p>
                Create your first support ticket.
            </p>

        </div>


    @endforelse


</div>

</body>

</html>
