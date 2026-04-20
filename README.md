# Unahin

Unahin is a Laravel task management app built around one core idea: focus on what comes first.

## Features

- Create, edit, complete, and delete tasks
- Use fixed system-defined tags for consistent categorization
- Get focus suggestions based on task urgency, priority, and effort
- Clean authentication flow for personal task management

## Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL 8+

## Run Locally

1. Clone the project and open it in your terminal.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Create your environment file if needed:

```bash
copy .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Create a MySQL database named `unahindb`.

7. Update your database credentials in `.env` if your MySQL username, password, host, or port are different from the defaults.

8. Run the migrations:

```bash
php artisan migrate
```

9. Seed the default local user:

```bash
php artisan db:seed
```

10. Start the backend server:

```bash
php artisan serve
```

11. In a second terminal, start Vite:

```bash
npm run dev
```

12. Open the app at `http://127.0.0.1:8000`.

## Default Login

- Email: `test@example.com`

## Testing

Run the test suite with:

```bash
php artisan test
```

Before running tests, create a separate MySQL database named `unahindb_test` or update the test database values in `phpunit.xml`.

## Notes

- The app uses a system-embedded tag registry instead of database-managed tags.
- Local sessions use file storage.
