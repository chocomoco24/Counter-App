# 🎛️ Laravel Counter App

A beginner-friendly Laravel project built to understand the **MVC architecture**, **database operations**, **authentication**, and **role-based access control** — all through a simple counter application.

---

## 📖 About

This project was built as a learning exercise to understand how Laravel works end-to-end. It covers models, controllers, views, migrations, seeders, middleware, and authentication — using a counter app as the practical example.

There are two roles:

- **Admin** — logs in, creates student accounts, and views all counters across all students
- **Student** — logs in, creates their own counters, and increments / decrements / resets / deletes them

Every counter value is persisted in a MySQL database, so refreshing the page always shows the last saved value.

---

## 🚀 Features

- Role-based authentication (Admin / Student)
- Admin can create student accounts with email and password
- Admin dashboard shows all counters from all students
- Student dashboard shows only their own counters
- Create multiple counters per student
- Increment, decrement, reset, and delete counters
- All values saved to MySQL — persists across page refreshes
- Middleware protection on all routes
- Admin seeder for quick setup
- Clean, minimal UI with no frontend framework

---

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php       # Login, logout
│   │   ├── AdminController.php      # Admin dashboard, create students
│   │   └── CounterController.php    # Counter CRUD for students
│   └── Middleware/
│       ├── AdminMiddleware.php       # Blocks non-admins from /admin routes
│       └── StudentMiddleware.php     # Blocks non-students from /student routes
└── Models/
    ├── User.php                      # Role helpers: isAdmin(), isStudent()
    └── Counter.php                   # Belongs to a User

database/
├── migrations/
│   ├── create_users_table.php
│   ├── add_role_to_users_table.php
│   ├── create_counters_table.php
│   └── add_user_id_to_counters_table.php
└── seeders/
    └── AdminSeeder.php               # Creates default admin account

resources/views/
├── auth/
│   └── login.blade.php               # Shared login page (admin + student)
├── admin/
│   ├── dashboard.blade.php           # View all counters
│   ├── students.blade.php            # List all students
│   └── create-student.blade.php      # Create student + show credentials
└── student/
    └── dashboard.blade.php           # Counter grid with +/−/reset/delete

routes/
└── web.php                           # All routes with middleware groups
```

---

## 🛠️ Tech Stack

| Layer      | Technology          |
|------------|---------------------|
| Framework  | Laravel 11          |
| Language   | PHP 8.2+            |
| Database   | MySQL               |
| Frontend   | Blade templates, plain CSS |
| Auth       | Laravel session auth (built-in) |

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/laravel-counter-app.git
cd laravel-counter-app
```

### 2. Install dependencies

```bash
composer install
```

### 3. Set up environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=counter_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Create the database

```sql
CREATE DATABASE counter_app;
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Seed the admin account

```bash
php artisan db:seed --class=AdminSeeder
```

### 7. Start the server

```bash
php artisan serve
```

Visit **http://127.0.0.1:8000**

---

## 🔑 Default Credentials

| Role    | Email             | Password  |
|---------|-------------------|-----------|
| Admin   | admin@admin.com   | admin123  |
| Student | created by admin  | set by admin |

> **Note:** Change the admin password after first login in a production environment.

---

## 📌 Routes Overview

| Method | URL | Description | Access |
|--------|-----|-------------|--------|
| GET | `/login` | Login page | Public |
| POST | `/login` | Handle login | Public |
| POST | `/logout` | Logout | Auth |
| GET | `/admin/dashboard` | View all counters | Admin |
| GET | `/admin/students` | List all students | Admin |
| GET | `/admin/students/create` | Create student form | Admin |
| POST | `/admin/students/create` | Store new student | Admin |
| GET | `/student/dashboard` | Student counter grid | Student |
| POST | `/student/counters` | Create new counter | Student |
| POST | `/student/counters/{id}/increment` | Increment | Student |
| POST | `/student/counters/{id}/decrement` | Decrement | Student |
| POST | `/student/counters/{id}/reset` | Reset to zero | Student |
| DELETE | `/student/counters/{id}` | Delete counter | Student |

---

## 🧠 What This Project Teaches

- **MVC pattern** — how Models, Views, and Controllers work together
- **Migrations** — version-controlling your database schema
- **Seeders** — pre-populating the database with default data
- **Eloquent ORM** — `hasMany`, `belongsTo`, `firstOrCreate`, `updateOrCreate`
- **Middleware** — protecting routes based on user role
- **Session-based authentication** — `Auth::attempt()`, `Auth::user()`, `Auth::logout()`
- **Blade templating** — `@csrf`, `@method`, `@forelse`, `@error`, `{{ }}` syntax
- **Route groups** — grouping routes by middleware and prefix
- **Flash messages** — passing data between redirects via session

---

## 📸 Screenshots

| Page | Description |
|------|-------------|
| `/login` | Shared login with role cards |
| `/admin/dashboard` | Table of all student counters |
| `/admin/students/create` | Create student + credential reveal |
| `/student/dashboard` | Counter grid with +/−/reset/delete |

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

## 🙌 Acknowledgements

Built as a step-by-step learning project to understand Laravel fundamentals — from file structure to authentication and role-based access control.
