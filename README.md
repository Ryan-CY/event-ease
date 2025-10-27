# 🎟️ Event Ease — Event Registration & Management System

A Laravel backend application for event management, and participant registration.

---

## 📘 Project Overview

**Event Ease** is a **backend Laravel application** built with the **MVC (Model–View–Controller)** architecture.

It provides both **Web (Blade-based)** and **RESTful API** interfaces for managing events and participant registration.

Users can:

- Create, update, and delete events
- View event details via web pages or API endpoints
- Register for or withdraw from events
- Authenticate and manage access via **Laravel Sanctum**

The project uses a **Service Layer** to centralize business logic shared between Web and API controllers, ensuring maintainability, scalability, and cleaner code.

It also supports **dynamic relationship loading** using the `?include=` query parameter, allowing flexible and optimized API responses.

---

## 🏃‍♂️  How to Run the Project

### Prerequisites

Make sure the following tools are installed:

- PHP 8.4+
- Composer
- Docker
- Git

---

### Setup Instructions

```bash
# 1️⃣ Clone the repository
git clone https://github.com/Ryan-CY/event-ease.git
cd event-ease

# 2️⃣ Install dependencies
composer install

# 3️⃣ Configure environment
cp .env.example .env
php artisan key:generate

# 4️⃣ Start MySQL container
docker-compose up -d

# 5️⃣ Run migrations and seed test data
php artisan migrate --seed

# 6️⃣ Serve the Laravel application locally
php artisan serve
```

- 🌐 Web Interface → http://localhost:8000/events
- 🔗 API Endpoint → http://localhost:8000/api/events

---

## 💡 Tech Stack

| Category | Technology / Tool | Description |
| --- | --- | --- |
| **Framework** | Laravel 12.21 (PHP 8.4) | Backend framework built on the MVC architecture |
| **Database** | MySQL 9.3 | Stores users, events, and participant records |
| **Authentication** | Laravel Sanctum | Token-based authentication for API and session login for Web |
| **Architecture** | MVC + Service Layer | Separation of concerns with centralized business logic |
| **View Engine** | Blade + Tailwind CSS | Server-rendered templates for Web interface |
| **ORM** | Eloquent ORM | Defines model relationships and handles database queries |
| **Validation** | Form Request / EventValidationRules Trait | Centralized validation for both Web and API controllers |
| **Development Tools** | Docker (MySQL), Composer, VS Code, Git | Containerized DB setup and modern PHP development workflow |

---

## 🌟 Core Features

| Aspect | Description |
| --- | --- |
| **Clean Architecture** | Combines Laravel’s **MVC** pattern with a custom **Service Layer** to separate concerns and improve maintainability. |
| **Dual Interface** | Supports both **Web (Blade)** and **RESTful API** layers within the same backend. |
| **Dynamic Relationship Loading** | `LoadRelationships` trait enables dynamic eager loading via `?include=` for flexible data retrieval. |
| **Service Layer Abstraction** | Common business logic is centralized in the `EventService` to prevent code duplication between Web and API controllers. |
| **Consistent Validation** | Centralized rules in `EventValidationRules` ensure uniform validation across controllers. |
| **Secure Authentication** | Laravel Sanctum provides **token-based API** security and **session-based Web** login. |
| **Authorization & Policies** | Access control is implemented through Laravel Policies to ensure secure CRUD operations. |
| **Database-Driven Design** | Uses Eloquent ORM with relationships between `User`, `Event`, and `Participant`. |
| **Readable Commit History** | Follows **Conventional Commits** for clear, semantic version tracking. |

---
## 👨‍💻 Project Maintainer

Ryan Lin
- 💡 Software & Programming Enthusiast
- 📧 phillin820109@msn.com

---

## ⚖️ License

This project is open-sourced under the **MIT License**.

---
