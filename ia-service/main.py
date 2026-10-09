from fastapi import FastAPI
from pydantic import BaseModel

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression


# ==================================================
# FastAPI Application
# ==================================================

app = FastAPI(title="SmartDesk AI")


# ==================================================
# Training Dataset
# ==================================================

texts = [

    # ---------------- Network ----------------
    "Wi-Fi is not working",
    "I cannot connect to the internet",
    "Network connection is very slow",
    "The router is not working",
    "Internet connection problem",

    # ---------------- Software ----------------
    "The application crashes",
    "The software does not open",
    "I have an error in the application",
    "The program is not working",
    "The application is very slow",

    # ---------------- Hardware ----------------
    "My computer does not turn on",
    "The keyboard is not working",
    "My screen is black",
    "The mouse does not work",
    "The printer is not working",

    # ---------------- Account ----------------
    "I forgot my password",
    "I cannot login to my account",
    "My account is locked",
    "I cannot access my account",
    "I need to reset my password",
]


categories = [

    # Network
    "network",
    "network",
    "network",
    "network",
    "network",

    # Software
    "software",
    "software",
    "software",
    "software",
    "software",

    # Hardware
    "hardware",
    "hardware",
    "hardware",
    "hardware",
    "hardware",

    # Account
    "account",
    "account",
    "account",
    "account",
    "account",
]


# ==================================================
# TF-IDF Vectorization
# ==================================================

vectorizer = TfidfVectorizer()

X = vectorizer.fit_transform(texts)


# ==================================================
# Machine Learning Model
# ==================================================

model = LogisticRegression(max_iter=1000)

model.fit(X, categories)


# ==================================================
# Request Models
# ==================================================

class Ticket(BaseModel):
    description: str


class ChatMessage(BaseModel):
    message: str
    history: list = []


# ==================================================
# Home Endpoint
# ==================================================

@app.get("/")
def home():

    return {
        "message": "SmartDesk AI is running"
    }


# ==================================================
# AI Analysis Function
# ==================================================

def analyze_text(description: str):

    # ------------------------------------------------
    # Transform text into TF-IDF
    # ------------------------------------------------

    X_ticket = vectorizer.transform([description])


    # ------------------------------------------------
    # Predict category
    # ------------------------------------------------

    category = model.predict(X_ticket)[0]


    # ------------------------------------------------
    # Calculate confidence
    # ------------------------------------------------

    probabilities = model.predict_proba(X_ticket)[0]

    confidence = max(probabilities)


    # ------------------------------------------------
    # Determine priority
    # ------------------------------------------------

    urgent_words = [
        "urgent",
        "critical",
        "emergency",
        "cannot work",
        "cannot connect",
        "system down",
        "not working",
        "blocked",
        "important"
    ]

    description_lower = description.lower()


    if any(
        word in description_lower
        for word in urgent_words
    ):

        priority = "high"

    elif confidence >= 0.50:

        priority = "medium"

    else:

        priority = "low"


    # ------------------------------------------------
    # Generate solution
    # ------------------------------------------------

    solutions = {

        "network":
            "Please check your Wi-Fi connection, restart "
            "your router, and verify the network settings.",

        "software":
            "Please restart the application, check for "
            "available updates, and reinstall the software "
            "if the problem continues.",

        "hardware":
            "Please check the device connections, restart "
            "the device, and verify the hardware components.",

        "account":
            "Please verify your login information and reset "
            "your password if necessary."
    }


    solution = solutions.get(
        category,
        "Please provide more information about the problem."
    )


    return {

        "category": category,

        "priority": priority,

        "confidence": round(
            float(confidence),
            2
        ),

        "solution": solution
    }


# ==================================================
# Analyze Ticket Endpoint
# ==================================================

@app.post("/analyze")
def analyze_ticket(ticket: Ticket):

    result = analyze_text(
        ticket.description
    )


    suggestion = (
        f"This ticket seems related to "
        f"{result['category']}."
    )


    return {

        "category":
            result["category"],

        "priority":
            result["priority"],

        "confidence":
            result["confidence"],

        "suggestion":
            suggestion,

        "solution":
            result["solution"]
    }


# ==================================================
# Chat Endpoint
# ==================================================

@app.post("/chat")
def chat(chat_message: ChatMessage):

    # ------------------------------------------------
    # Get current message
    # ------------------------------------------------

    message = chat_message.message.strip()


    # ------------------------------------------------
    # Empty message
    # ------------------------------------------------

    if not message:

        return {

            "response":
                "Please describe your technical problem "
                "so I can help you.",

            "category": None,

            "priority": None,

            "confidence": 0,

            "solution": None
        }


    # ------------------------------------------------
    # Analyze current message
    # ------------------------------------------------

    result = analyze_text(message)


    category = result["category"]

    priority = result["priority"]

    confidence = result["confidence"]

    solution = result["solution"]


    # ------------------------------------------------
    # Conversation history
    # ------------------------------------------------

    history = chat_message.history

    previous_category = None


    if history:

        for item in reversed(history):

            if item.get("category"):

                previous_category = item["category"]

                break


    # ------------------------------------------------
    # Detect short/context messages
    # ------------------------------------------------

    short_messages = [

        "that",
        "this",
        "it",
        "already did",
        "i did",
        "still not working",
        "it still doesn't work",
        "same problem"

    ]


    message_lower = message.lower()


    is_context_message = (

        len(message.split()) <= 5

        or any(
            text in message_lower
            for text in short_messages
        )

    )


    # ------------------------------------------------
    # Use previous conversation context
    # ------------------------------------------------

    if previous_category and is_context_message:

        category = previous_category

        priority = "medium"

        confidence = 0.90


        contextual_solutions = {

            "network":
                "Since you are still having the network "
                "problem, please check your Wi-Fi settings "
                "and try restarting the router again.",

            "software":
                "Since the software problem is still "
                "happening, please restart the application "
                "and check for updates.",

            "hardware":
                "Since the hardware problem is still "
                "happening, please check the device "
                "connections and restart the device.",

            "account":
                "Since you are still having an account "
                "problem, please verify your login "
                "information or reset your password."
        }


        solution = contextual_solutions.get(

            category,

            "Please provide more details "
            "about the problem."

        )


    # ------------------------------------------------
    # Generate conversational response
    # ------------------------------------------------

    responses = {

        "network":
            f"I understand. This seems to be a "
            f"network problem.\n\n"
            f"💡 {solution}\n\n"
            f"If the problem continues, tell me what "
            f"happens when you try to connect.",


        "software":
            f"I understand. This seems to be a "
            f"software problem.\n\n"
            f"💡 {solution}\n\n"
            f"If it still doesn't work, tell me the "
            f"application name and any error message "
            f"you see.",


        "hardware":
            f"I understand. This seems to be a "
            f"hardware problem.\n\n"
            f"💡 {solution}\n\n"
            f"Tell me which device is causing the "
            f"problem if you need more help.",


        "account":
            f"I understand. This seems to be an "
            f"account problem.\n\n"
            f"💡 {solution}\n\n"
            f"If you still cannot access your account, "
            f"tell me what message you see."
    }


    response = responses.get(

        category,

        "I understand your problem. Could you give "
        "me a little more information so I can help you?"
    )


    # ------------------------------------------------
    # Return response
    # ------------------------------------------------

    return {

        "response":
            response,

        "category":
            category,

        "priority":
            priority,

        "confidence":
            confidence,

        "solution":
            solution
    }