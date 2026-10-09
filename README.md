
# SmartDesk AI 🤖

**An AI-powered IT Helpdesk System built with Laravel and Python FastAPI.**

SmartDesk AI is a web application designed to help users manage IT support tickets and receive AI-assisted troubleshooting recommendations. It combines a Laravel web interface with a Python-based AI service.

## ✨ Features

- **Ticket Management:** Create, view, and manage IT support tickets.
- **AI Ticket Classification:** Automatically analyze support requests and predict their category.
- **Priority Prediction:** Help identify ticket priority.
- **Confidence Score:** Display the AI model's prediction confidence.
- **Smart Suggestions:** Provide recommendations to help troubleshoot common technical issues.
- **AI Chat Assistant:** Interact with an AI-powered assistant for IT support.
- **REST API Integration:** Connect the Laravel application to the Python AI service.

## 🛠️ Technologies

### Backend
- PHP
- Laravel
- Python
- FastAPI

### Artificial Intelligence
- Machine Learning
- Scikit-learn
- TF-IDF text vectorization
- Logistic Regression

### Frontend and Data
- Blade Templates
- HTML
- CSS
- JavaScript
- SQL database

## 🏗️ Architecture

The project is organized into two main components:

```text
smartdesk-ai/
├── ia-service/    # Python AI service
├── laravel/       # Laravel web application
└── README.md
```

**Laravel Application**
- Provides the web interface.
- Manages support tickets and user interactions.
- Communicates with the AI service.

**Python AI Service**
- Processes support-related text.
- Classifies IT support requests.
- Provides AI predictions and chat functionality through API endpoints.

## 🚀 Local Setup

### Prerequisites

- PHP and Composer
- Node.js and npm
- Python 3.11 or compatible version
- Git

### 1. Clone the repository

```bash
git clone https://github.com/Oumaimamosbehi/SmartDesk-AI.git
cd SmartDesk-AI
```

### 2. Set up Laravel

```bash
cd laravel
composer install
```

Create your local environment file:

```powershell
Copy-Item .env.example .env
```

Configure your database settings in `.env`, then run:

```bash
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

### 3. Set up the Python AI service

Open a separate terminal:

```bash
cd ia-service
python -m venv venv
```

Activate the virtual environment on Windows:

```powershell
.\venv\Scripts\Activate.ps1
```

Install the Python dependencies using the project's dependency file, if provided:

```bash
pip install -r requirements.txt
```

Start the FastAPI service using the module and application name configured in your project. For example, if the FastAPI instance is named `app` in `main.py`:

```bash
uvicorn main:app --reload --port 8001
```

Keep the Laravel application and AI service running in separate terminals. Configure the Laravel application to use the AI service URL expected by your code.

## 🔐 Security

- Never commit `.env` files, API keys, passwords, or other secrets.
- Do not upload Python virtual environments or dependency folders.
- Store private configuration in local environment variables.

## 🎯 Project Goal

SmartDesk AI explores how machine learning can support IT helpdesk workflows by automating ticket classification, assisting troubleshooting, and improving the user support experience.

## 👩‍💻 Author

**Oumaima Mosbahi**

Computer Science graduate specializing in intelligent and pervasive systems.

Interested in Artificial Intelligence, Machine Learning, Data Science, and Web Development.
