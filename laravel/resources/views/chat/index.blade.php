<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartDesk AI - Chat</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {

            font-family: Arial, sans-serif;

            background: #f5f7fb;

            height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

        }


        .chat-container {

            width: 95%;

            max-width: 900px;

            height: 90vh;

            background: white;

            border-radius: 16px;

            box-shadow: 0 8px 30px rgba(0,0,0,0.08);

            display: flex;

            flex-direction: column;

            overflow: hidden;

        }


        /* =========================
           HEADER
        ========================== */

        .chat-header {

            background: #2563eb;

            color: white;

            padding: 20px 25px;

            display: flex;

            justify-content: space-between;

            align-items: center;

        }


        .brand {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .robot {

            font-size: 30px;

        }


        .brand h1 {

            font-size: 20px;

        }


        .brand p {

            font-size: 13px;

            opacity: 0.85;

            margin-top: 4px;

        }


        .dashboard-link {

            color: white;

            text-decoration: none;

            background: rgba(255,255,255,0.15);

            padding: 9px 13px;

            border-radius: 7px;

            font-size: 13px;

        }


        /* =========================
           CHAT AREA
        ========================== */

        .chat-messages {

            flex: 1;

            padding: 25px;

            overflow-y: auto;

            background: #f8fafc;

        }


        .message {

            display: flex;

            margin-bottom: 20px;

        }


        .message.ai {

            justify-content: flex-start;

        }


        .message.user {

            justify-content: flex-end;

        }


        .message-content {

            max-width: 70%;

            padding: 13px 17px;

            border-radius: 14px;

            line-height: 1.5;

            font-size: 15px;

        }


        .message.ai .message-content {

            background: white;

            color: #374151;

            border: 1px solid #e5e7eb;

            border-bottom-left-radius: 4px;

        }


        .message.user .message-content {

            background: #2563eb;

            color: white;

            border-bottom-right-radius: 4px;

        }


        .message-time {

            font-size: 11px;

            margin-top: 5px;

            color: #9ca3af;

        }


        /* =========================
           WELCOME
        ========================== */

        .welcome {

            text-align: center;

            padding: 40px 20px;

        }


        .welcome-icon {

            font-size: 50px;

            margin-bottom: 15px;

        }


        .welcome h2 {

            color: #111827;

            margin-bottom: 10px;

        }


        .welcome p {

            color: #6b7280;

            max-width: 500px;

            margin: auto;

            line-height: 1.6;

        }


        /* =========================
           INPUT
        ========================== */

        .chat-input-area {

            padding: 18px;

            background: white;

            border-top: 1px solid #e5e7eb;

        }


        .chat-form {

            display: flex;

            gap: 10px;

        }


        .chat-input {

            flex: 1;

            padding: 13px 16px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            outline: none;

            font-size: 15px;

        }


        .chat-input:focus {

            border-color: #2563eb;

        }


        .send-button {

            border: none;

            background: #2563eb;

            color: white;

            padding: 0 22px;

            border-radius: 10px;

            cursor: pointer;

            font-weight: bold;

        }


        .send-button:hover {

            background: #1d4ed8;

        }


        @media (max-width: 600px) {

            .chat-container {

                width: 100%;

                height: 100vh;

                border-radius: 0;

            }


            .message-content {

                max-width: 85%;

            }


            .dashboard-link {

                display: none;

            }

        }

    </style>

</head>


<body>


<div class="chat-container">


    <!-- =========================
         HEADER
    ========================== -->

    <div class="chat-header">

        <div class="brand">

            <div class="robot">
                🤖
            </div>

            <div>

                <h1>
                    SmartDesk AI
                </h1>

                <p>
                    AI Customer Support Assistant
                </p>

            </div>

        </div>


        <a
            href="{{ route('tickets.index') }}"
            class="dashboard-link"
        >
            Dashboard
        </a>

    </div>



    <!-- =========================
         MESSAGES
    ========================== -->

    <div class="chat-messages" id="chatMessages">


        <div class="welcome" id="welcomeMessage">

            <div class="welcome-icon">
                🤖
            </div>

            <h2>
                How can I help you?
            </h2>

            <p>
                Describe your technical problem and
                I'll help you troubleshoot it.
            </p>

        </div>


    </div>



    <!-- =========================
         INPUT
    ========================== -->

    <div class="chat-input-area">

        <form
            class="chat-form"
            id="chatForm"
        >

            <input
                type="text"
                id="messageInput"
                class="chat-input"
                placeholder="Describe your problem..."
                autocomplete="off"
                required
            >


            <button
                type="submit"
                class="send-button"
            >
                Send
            </button>

        </form>

    </div>


</div>



<script>

    // ==========================================
    // Conversation History
    // ==========================================

    let conversationHistory = [];


    // ==========================================
    // DOM Elements
    // ==========================================

    const chatForm =
        document.getElementById('chatForm');

    const messageInput =
        document.getElementById('messageInput');

    const chatMessages =
        document.getElementById('chatMessages');

    const welcomeMessage =
        document.getElementById('welcomeMessage');


    // ==========================================
    // Send Message
    // ==========================================

    chatForm.addEventListener(
        'submit',
        async function(event) {

            event.preventDefault();


            const message =
                messageInput.value.trim();


            if (!message) {
                return;
            }


            // ------------------------------------------
            // Remove welcome message
            // ------------------------------------------

            if (welcomeMessage) {
                welcomeMessage.remove();
            }


            // ------------------------------------------
            // Display user message
            // ------------------------------------------

            addMessage(
                message,
                'user'
            );


            // ------------------------------------------
            // Clear input
            // ------------------------------------------

            messageInput.value = '';


            // ------------------------------------------
            // Show loading message
            // ------------------------------------------

            const loadingMessage =
                addMessage(
                    '🤖 Thinking...',
                    'ai'
                );


            try {

                // --------------------------------------
                // Send message to Laravel
                // --------------------------------------

                const response =
                    await fetch(
                        "{{ route('chat.send') }}",
                        {
                            method: 'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}',

                                'Accept':
                                    'application/json'

                            },

                            body: JSON.stringify({

                                message: message,

                                history:
                                    conversationHistory

                            })

                        }
                    );


                // --------------------------------------
                // Convert response to JSON
                // --------------------------------------

                const data =
                    await response.json();


                // --------------------------------------
                // Remove loading message
                // --------------------------------------

                loadingMessage.remove();


                // --------------------------------------
                // Check errors
                // --------------------------------------

                if (!response.ok) {

                    addMessage(
                        '❌ Sorry, something went wrong. Please try again.',
                        'ai'
                    );

                    return;
                }


                // --------------------------------------
                // Display AI response
                // --------------------------------------

                addMessage(
                    data.response,
                    'ai'
                );


                // --------------------------------------
                // Save USER message in history
                // --------------------------------------

                conversationHistory.push({

                    role: 'user',

                    message: message

                });


                // --------------------------------------
                // Save AI response in history
                // --------------------------------------

                conversationHistory.push({

                    role: 'assistant',

                    message: data.response,

                    category: data.category,

                    priority: data.priority,

                    confidence: data.confidence

                });


                console.log(
                    'Conversation History:',
                    conversationHistory
                );


            } catch (error) {

                console.error(
                    'Chat Error:',
                    error
                );


                loadingMessage.remove();


                addMessage(
                    '❌ I cannot connect to SmartDesk AI right now. Please make sure the AI service is running.',
                    'ai'
                );

            }

        }
    );


    // ==========================================
    // Add Message to Chat
    // ==========================================

    function addMessage(
        text,
        type
    ) {

        const message =
            document.createElement('div');


        message.className =
            'message ' + type;


        const content =
            document.createElement('div');


        content.className =
            'message-content';


        // Preserve line breaks
        content.style.whiteSpace =
            'pre-line';


        content.textContent =
            text;


        message.appendChild(
            content
        );


        chatMessages.appendChild(
            message
        );


        // Scroll to bottom
        chatMessages.scrollTop =
            chatMessages.scrollHeight;


        return message;

    }

</script>


</body>

</html>
