# 🎓 Laravel Multi-Role Middleware (Code-Learning Version)

Repo ini berisi **kode mentah dan disederhanakan** untuk memahami konsep *multi-role system* di Laravel.  
Tujuannya bukan untuk langsung dipakai di production, tapi untuk membantu pemula **belajar alur logika role-based access** secara bersih dan mudah dipahami.

---
## 📘 Konsep Utama

- Middleware `RoleMiddleware` untuk memeriksa peran user (`admin`, `user`, dll).
- Model `User` punya field `role`.
- Route di `web.php` dibatasi berdasarkan role.

---

# 📂 Struktur Folder
app/
└── Http/
└── Middleware/
└── RoleMiddleware.php
routes/
└── web.php

php
Copy code

---

# ⚙️ Contoh Inti Middleware
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
🛠️ Contoh di Route
```php
Copy code
// routes/web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => 'Admin Panel');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', fn() => 'User Dashboard');
});
```
🎯 Tujuan
Memahami alur autentikasi dan role checking di Laravel.

Melihat struktur middleware & route yang jelas.

Menjadi dasar belajar sebelum implementasi multi-guard, policy, atau permission package (seperti Spatie).

⚠️ Catatan
Ini bukan template siap pakai — hanya core code yang bisa kamu pelajari, ubah, dan kembangkan sendiri.

```yaml
Copy code
```
---

# 💾 3️⃣ Inisialisasi Git dan push ke GitHub

```bash
cd ~/Projects/Laravel/middlewareAllRole
git init
git add .
git commit -m "init: add simplified multi-role middleware example for learning"
git branch -M main
git remote add origin https://github.com/Asyraf2003/middlewareAllRole.git
git push -u origin main
