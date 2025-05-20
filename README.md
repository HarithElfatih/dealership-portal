# Dealership Portal

The **Dealership Portal** is a PHP-based web application that allows users to browse a car dealership's vehicle inventory and view detailed information about each listing. Admins can log in, manage vehicle listings, and verify their accounts via email.

---

## Features

### Public Users
- Browse all available vehicles in the inventory.
- Click on a vehicle image to view more details.
- No login required to browse.

### Admin Panel
- **Signup**: Admins can register using a pre-approved email (see config).
- **Email Verification**: A verification link is sent to the admin's email. Account must be verified before logging in.
- **Login/Logout**: Session-based authentication.
- **Add Vehicles**: Only verified admins can add new vehicles to the inventory.
  
---

## Tech Stack

- **PHP 8.2 with Apache.**
- **MariaDB 10.4.**
- **Bootstrap 5.**
- **PHPMailer.**
- **Docker & Docker Compose.**

---

## Installation & Setup

### 1. Prerequisites

Ensure you have the following installed:

- [Docker]
- [Docker Compose]

---

### 2. Environment Configuration

Set up the following files before starting the app:

#### `.env` (Place in the project root: `dealership-portal/.env`)

```.env


DB_ROOT_PASS=PASS
DB_NAME=DB_NAME
DB_USER=USER
DB_PASS=PASS
```

#### `config.env` (Place in src/includes/config.env)

```config.env
DB_HOST=db          # Don't change this value
DB_PORT=3306        # Don't change this value
DB_USER=""          # Same as DB_USER from .env
DB_PASS=""          # Same as DB_PASS from .env
DB_NAME=""          # Same as DB_NAME from .env

email_password=""   # Gmail App Password for sending verification emails
admin_email=""                      # Gmail account used to send verification emails
application_url=localhost:8080      # Use server IP in production, or localhost for local dev

```

### 3. Start the Application
After setting up your .env and config.env files, navigate to the project root and run:
```
docker-compose up --build

```

