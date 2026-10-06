# Naufal Ramadhan - Personal Portfolio

Portfolio website built with Laravel, Tailwind CSS, and Three.js.

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Tailwind CSS, Vanilla JS
- **Database:** SQLite / MySQL

## Setup Instructions
1. Clone the repository
2. Run `composer install`
3. Run `npm install && npm run build`
4. Copy `.env.example` to `.env` and generate app key (`php artisan key:generate`)
5. Run migrations and seed data: `php artisan migrate --seed`
6. Start the server: `php artisan serve`
