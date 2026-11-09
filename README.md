# NoName Daycare — PHP/MySQL site with admin dashboard

Requires PHP 8.1+ and MySQL/MariaDB. No Composer or email setup needed.

## Install (XAMPP / cPanel / Linux)
1. Copy this folder into your web root (e.g. `htdocs/noname-daycare`).
2. Import `database/schema.sql` (phpMyAdmin or `mysql < database/schema.sql`).
3. Copy `config/config.local.php.example` to `config/config.local.php` and set your DB details.
4. Visit `/admin/` — first run asks you to create the admin account. Then DELETE `admin/setup.php`.
5. Edit the placeholder name/address/phone in `config/config.php`.

## How it works
Tour form -> validation (CSRF, honeypot, rate limit) -> saved in the `inquiries` table.
No emails are sent. View and manage inquiries in /admin/ (search, filter, status, notes, delete).
