# 🍽️ Le Restaurant

A restaurant website built with Laravel. Visitors see an animated landing page with a filterable menu, and the owner manages categories and dishes from a login-protected admin panel.

---

## ✨ Features

**Public site**
- Dark, animated landing page with a 3D rotating burger scene (Three.js) and scroll/entrance animations (GSAP)
- Menu with category filter buttons (All, Appetizers, Main Courses, Desserts, Drinks), filtered instantly without a page reload (Alpine.js)
- Each dish shows its photo, name, description and price
- Responsive layout built with Tailwind CSS

**Admin panel** (requires login)
- Dashboard with quick links
- Create, edit and delete **categories** (slugs are generated automatically)
- Create, edit and delete **meals** with name, description, price, category and image upload (max 2 MB, old images are removed when replaced or deleted)
- Paginated lists, form validation and success messages
- Profile page to update name, email and password

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+, MySQL
- **Authentication:** Laravel Breeze
- **Frontend:** Blade templates, Tailwind CSS 3, Alpine.js
- **Animation and 3D:** GSAP, Three.js
- **Build tool:** Vite

---

## 🏃 Getting Started Locally

**Requirements:** PHP 8.2+, Composer, Node.js and npm, and a MySQL database.

### 1. Install dependencies
```bash
composer install
npm install
```

### 2. Set up the environment
```bash
cp .env.example .env
php artisan key:generate
```
Create a MySQL database named `restaurant`, then check the `DB_*` values in `.env` (host, port, database, username, password).

### 3. Create the tables and sample data
```bash
php artisan migrate --seed
php artisan storage:link
```
The seeder creates four categories, four sample dishes and an admin account:

- **Email:** `admin@example.com`
- **Password:** `password`

Change this password before deploying anywhere public.

The sample dishes point to images in `storage/app/public/meals/`, which are not included in the repository. Upload your own dish photos from the admin panel, or the sample dishes will show without images.

### 4. Run the app
```bash
npm run dev
php artisan serve
```
Open `http://localhost:8000`. The admin panel is at `/admin/dashboard` after you log in.

For a production build, run `npm run build` instead of `npm run dev`.

---

## 📁 Project Structure

| Path | What it holds |
|---|---|
| `app/Http/Controllers/MealController.php` | Meal CRUD and image upload handling |
| `app/Http/Controllers/CategoryController.php` | Category CRUD |
| `app/Models/` | `Meal`, `Category` and `User` models |
| `database/migrations/` | Tables for categories, meals, users, jobs and cache |
| `database/seeders/DatabaseSeeder.php` | Sample categories, meals and admin user |
| `resources/views/welcome.blade.php` | Public landing page and menu |
| `resources/views/admin/` | Admin dashboard, category and meal screens |
| `routes/web.php` | Public route and the `/admin` route group |

---

## 🗺️ Possible Next Steps

- Online table reservations (the landing page has a "Reserve" button that currently leads to the login page)
- Restricting admin access to a single owner account
- Order management and online payments
