<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartDesk AI - Edit Ticket</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 700px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        h1 {
            color: #1f2937;
            margin-bottom: 10px;
        }

        .ticket-info {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #374151;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Ticket #{{ $ticket->id }}</h1>

    <p class="ticket-info">
        {{ $ticket->subject }}
    </p>

    <form action="{{ route('tickets.update', $ticket) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category">Category</label>

            <select name="category" id="category">
                <option value="">Select category</option>

                <option value="network"
                    {{ $ticket->category == 'network' ? 'selected' : '' }}>
                    Network
                </option>

                <option value="software"
                    {{ $ticket->category == 'software' ? 'selected' : '' }}>
                    Software
                </option>

                <option value="hardware"
                    {{ $ticket->category == 'hardware' ? 'selected' : '' }}>
                    Hardware
                </option>

                <option value="account"
                    {{ $ticket->category == 'account' ? 'selected' : '' }}>
                    Account
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>

            <select name="priority" id="priority">

                <option value="low"
                    {{ $ticket->priority == 'low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="medium"
                    {{ $ticket->priority == 'medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="high"
                    {{ $ticket->priority == 'high' ? 'selected' : '' }}>
                    High
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>

            <select name="status" id="status">

                <option value="open"
                    {{ $ticket->status == 'open' ? 'selected' : '' }}>
                    Open
                </option>

                <option value="in_progress"
                    {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="resolved"
                    {{ $ticket->status == 'resolved' ? 'selected' : '' }}>
                    Resolved
                </option>

            </select>
        </div>

        <button type="submit">
            Update Ticket
        </button>

    </form>

    <a href="{{ route('tickets.index') }}" class="back">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>