# How to Turn This Into a Working Laravel Project

I don't have PHP/Composer available to generate the full Laravel skeleton (the
`vendor/`, `bootstrap/`, `config/`, `public/index.php`, `artisan`, etc. files
Laravel needs to run) or to test-run this code. What I've given you are the
**application files you write yourself** in a normal Laravel mini-project —
migration, model, controller, routes, and views. Follow these steps to drop
them into a real Laravel install.

## 1. Install Laravel (requires PHP 8.2+ and Composer)

```bash
composer create-project laravel/laravel task-manager
cd task-manager
```

## 2. Copy in these files

From this folder, copy each file into the matching path in your new
`task-manager` project, overwriting where needed:

| From this folder                                      | Goes to                                                |
|---------------------------------------------------------|---------------------------------------------------------|
| `database/migrations/2026_01_01_000000_create_tasks_table.php` | `database/migrations/`                          |
| `app/Models/Task.php`                                    | `app/Models/Task.php`                                    |
| `app/Http/Controllers/TaskController.php`                | `app/Http/Controllers/TaskController.php`                |
| `routes/web.php`                                          | `routes/web.php` (replace the existing file)             |
| `resources/views/layouts/app.blade.php`                   | `resources/views/layouts/app.blade.php`                  |
| `resources/views/tasks/*.blade.php`                       | `resources/views/tasks/`                                  |
| `README.md`                                                | project root (replace the existing one)                  |

## 3. Configure your database

Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```
Create the `task_manager` database in MySQL (e.g. via phpMyAdmin, TablePlus,
or `mysql -u root -e "CREATE DATABASE task_manager"`).

## 4. Run migrations and start the server

```bash
php artisan migrate
php artisan serve
```

Visit `http://127.0.0.1:8000` — it will redirect to `/tasks`.

## 5. Push to GitHub

```bash
git init
git add .
git commit -m "Personal Task Manager - Laravel mini project"
git branch -M main
git remote add origin <your-empty-github-repo-url>
git push -u origin main
```

Make sure the repo is **public** before submitting the URL.

## Understanding the code (you'll likely be asked to explain this)

- **Migration** (`create_tasks_table.php`): defines the `tasks` table schema —
  `task_name`, `description`, `status` (enum: Pending/Completed), `due_date`,
  plus Laravel's automatic `id` and timestamps.
- **Model** (`Task.php`): Eloquent model mapped to the `tasks` table.
  `$fillable` whitelists which fields can be mass-assigned via
  `Task::create($validated)`. `$casts` turns `due_date` into a Carbon date
  object automatically.
- **Controller** (`TaskController.php`): one method per action —
  `index` (list), `create`/`store` (add), `edit`/`update` (edit),
  `destroy` (delete), plus a custom `updateStatus` for the one-click toggle
  button. Laravel's **route model binding** (`Task $task` in the method
  signature) automatically fetches the right row from the URL's `{task}` id.
- **Routes** (`web.php`): `Route::resource('tasks', TaskController::class)`
  is shorthand that generates all 7 standard RESTful routes
  (index/create/store/show/edit/update/destroy) in one line. The extra
  `PATCH /tasks/{task}/status` route is added manually for the status toggle.
- **Views** (`resources/views/tasks/*.blade.php`): Blade templates extend a
  shared `layouts/app.blade.php` (navbar + styling). Forms use `@csrf` for
  CSRF protection and `@method('PUT')`/`@method('DELETE')` because HTML forms
  only natively support GET/POST — Laravel "spoofs" the other HTTP verbs.

Be ready to explain any of the above in your own words during checking.
