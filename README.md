# Personal Task Manager

Project Code: WST21-PM-2026-SF
Student Name: 
Course & Year: 
Database Used: MySQL

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status (Pending / Completed)

## About
A simple Laravel CRUD application for managing personal tasks, built using the
Routes → Controller → Model → Database → Blade flow.

## Tech Stack
- Laravel 11
- Blade templates
- Bootstrap 5 (CDN)
- MySQL

## Local Setup
1. Clone this repository
   ```
   git clone <your-repo-url>
   cd task-manager
   ```
2. Install dependencies
   ```
   composer install
   ```
3. Copy the environment file and generate an app key
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. Set your database credentials in `.env`
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Run migrations
   ```
   php artisan migrate
   ```
6. Start the development server
   ```
   php artisan serve
   ```
7. Visit `http://127.0.0.1:8000` in your browser.

## Screenshots
_Add screenshots of your running app here._
