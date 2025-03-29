# **Laravel Task Management Application**
A robust and user-friendly web-based task management application built with Laravel. Manage tasks efficiently with features like task categories, priorities, statuses, and due dates.
## **Features**
- Create, edit, and delete tasks.
- Assign tasks to categories (optional).
- Set task priorities (Low, Medium, High).
- Manage task statuses (New, In Progress, Completed).
- Task due date validation to ensure proper deadlines.
- Dashboard with summary ( the number of task by status and priority )
- User authentication and task-specific access.
- Responsive front-end with Blade templates and Tailwind CSS integration.
- Developer tools like debugging and query logging via Laravel Debugbar.

## **Tech Stack**
### **Backend:**
- **Laravel 12.2.0**: PHP framework.
- **SQLite**: Database for local development.
- **PHP 8.2**: Preferred PHP version.
- **Composer**: Dependency management.

### **Frontend:**
- **Livewire**: Dynamic front-end functionality with server-side rendering.
- **Tailwind CSS**: Modern, utility-first CSS framework for styling.
- **Vite**: Lightning-fast build tool for asset bundling.

### **Other Tools:**
- **Laravel Debugbar**: Debugging queries and performance issues.
- **Laravel Sail**: Minimal Docker-based local development environment.
- **npm**: JavaScript package management.


## **Installation Instructions**
Follow these steps to get the project up and running on your local machine:
### **Prerequisites:**
- PHP `>= 8.2`.
- Composer.
- Node.js and npm.
- A web server like Apache or Nginx.
- Docker (if you intend to use Laravel Sail).

### **Step 1: Clone the Repository**
Clone the project repository:
```bash
git clone https://github.com/Tibebu-ES/task-manager.git
cd task-manager
```
### **Step 2: Install Dependencies**
Install PHP dependencies using Composer:
```bash
composer install
```
Install JavaScript dependencies using npm:
```bash
npm install
```
### **Step 3: Set Environment Variables**
- Copy the `.env.example` file and create a `.env` file:
 ```bash
cp .env.example .env
```
- Update the `.env` file to configure your local settings. For example:
 ```
  APP_NAME=LaravelTaskApp
  APP_URL=http://localhost
  DB_CONNECTION=sqlite
  QUEUE_CONNECTION=database
```
- Generate the application key:
   ```bash
  php artisan key:generate
```
### **Step 4: Set Up the Database**
- For SQLite:
    - Create the database file:
  ```bash
  touch database/database.sqlite
```
- Run the database migrations:
  ```bash
  php artisan migrate
```
- Seed the database (optional):
```bash
  php artisan db:seed
```
### **Step 5: Build Front-End Assets**
Compile front-end assets using Vite:
```bash
  npm run dev
```
### **Step 6: Start the Application**
Run the development server:
```bash
  php artisan serve
```
Your application should now be running at: `http://127.0.0.1:8000`

## **Usage Instructions**
### **Task Management**
- Log in to your account.
- Access the "Tasks" page to view, create, and manage tasks.
- Use categories to organize tasks or leave them uncategorized.
- Set due dates and change task priorities and statuses as required.

## **Project Structure**
### Key Directories:
- **`app/Models`**: Contains Eloquent models for `Task`, `TaskCategory`, and related entities.
- **`app/Livewire/Tasks`**: Livewire components for task management UI.
- **`app/Livewire/TaskCategories`**: Livewire components for task category management UI.
- **`resources/views`**: Blade templates for front-end views.
- **`database/factories`**: Factories for seeding test data.
- **`database/migrations`**: Database schema definitions.
