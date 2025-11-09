```
# 🎓 Laravel Multi-Role Middleware (Code-Learning Version)

This repository contains **simplified and raw code** to help you understand how a *multi-role system* works in Laravel.  
The purpose is not for production use, but to help beginners **learn the logic flow of role-based access** in a clean and minimal way.

---

## 📘 Core Concept

- A custom middleware `RoleMiddleware` checks a user’s role (`admin`, `user`, etc.).
- The `User` model contains a `role` field.
- Routes in `web.php` are restricted based on role.

---

## 📂 Folder Structure

```
app/
└── Http/
    └── Middleware/
        └── RoleMiddleware.php
routes/
└── web.php
```

---

## ⚙️ Core Middleware Example

```php
// app/Http/Middleware/RoleMiddleware.php
public function handle($request, Closure $next, ...$roles)
{
    if (!in_array(auth()->user()->role, $roles)) {
        abort(403, 'Access denied.');
    }
    return $next($request);
}
```

---

## 🛠️ Example Routes

```php
// routes/web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => 'Admin Panel');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', fn() => 'User Dashboard');
});
```

---

## 🎯 Goal

- Understand the authentication and role-checking flow in Laravel.  
- See a clear structure of middleware and routes.  
- Build a foundation before moving to more advanced role systems like **multi-guard**, **policy**, or **permission packages** (e.g., Spatie Laravel Permission).

---

## ⚠️ Note

This is **not** a ready-to-use template.  
It’s a simple code base intended for learning, experimentation, and further modification.

---

## 💾 Initialize Git and Push to GitHub

```bash
cd ~/Projects/Laravel/middlewareAllRole
git init
git add .
git commit -m "init: add simplified multi-role middleware example for learning"
git branch -M main
git remote add origin https://github.com/Asyraf2003/middlewareAllRole.git
git push -u origin main
```
```
