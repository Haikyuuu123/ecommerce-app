# Laravel E-Commerce Setup

This is a full-stack Laravel e-commerce CRUD project for XAMPP, PHP, and MySQL/MariaDB.

## Included

- Storefront home page
- Product listing and product detail pages
- Session cart
- Checkout form
- Order creation with order items
- Admin dashboard
- Admin category CRUD
- Admin product CRUD
- Admin order list, detail, and status update
- MySQL migrations and starter seed data

## Open In VS Code

Open this folder:

`C:\Users\User\Documents\Codex\2026-06-21\bu\outputs\ecommerce-laravel`

## XAMPP Database

Your XAMPP MySQL config is set to port `3307`, so `.env` already uses:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=laravel_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Start MySQL from the XAMPP Control Panel. If it fails with database file permission errors, run XAMPP as Administrator.

Then create the database:

```powershell
C:\xampp\mysql\bin\mysql.exe -h 127.0.0.1 -P 3307 -u root < database\create_database.sql
```

## Install And Run

From the project folder:

```powershell
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open:

- Storefront: `http://127.0.0.1:8000`
- Admin dashboard: `http://127.0.0.1:8000/admin`

## Seeded Admin User

The seeded user is available for future auth work:

- Email: `admin@example.com`
- Password: `password`

This starter does not lock the admin dashboard behind login yet, so you can test CRUD immediately.
